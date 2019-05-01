<?php
declare(strict_types=1);

namespace App\Http\Controllers\MailChimp;

use App\Database\Entities\MailChimp\MailChimpListMember;
use App\Database\Entities\MailChimp\MailChimpList;
use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mailchimp\Mailchimp;

class ListMembersController extends Controller
{
    /**
     * @var \Mailchimp\Mailchimp
     */
    private $mailChimp;

    /**
     * ListsController constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param \Mailchimp\Mailchimp $mailchimp
     */
    public function __construct(EntityManagerInterface $entityManager, Mailchimp $mailchimp)
    {
        parent::__construct($entityManager);

        $this->mailChimp = $mailchimp;
    }

    /**
     * Create MailChimp list Member.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $listId): JsonResponse
    {
    	/** @var \App\Database\Entities\MailChimp\MailChimpList|null $list */
        $list = $this->entityManager->getRepository(MailChimpList::class)->find($listId);

        if ($list === null) {
            return $this->errorResponse(
                ['message' => \sprintf('MailChimpList[%s] not found', $listId)],
                404
            );
        }

        /** @var \App\Database\Entities\MailChimp\MailChimpListMember|null $listMember */
        $listMember = new MailChimpListMember($request->all());
        
        //set list member mailchimp lists id
        $listMember->setMailChimpListId($list->getMailChimpId());
        
        // Validate entity
        $validator = $this->getValidationFactory()->make($listMember->toMailChimpArray(), $listMember->getValidationRules());
        
        if ($validator->fails()) {
            // Return error response if validation failed
            return $this->errorResponse([
                'message' => 'Invalid data given',
                'errors' => $validator->errors()->toArray()
            ]);
        }

        try {
            // Save list into MailChimp
            $response = $this->mailChimp->post("lists/{$list->getMailChimpId()}/members", $listMember->toMailChimpArray());
            
            // Set MailChimp id on the list
            $listMember->setMailChimpId($response->get('id'));
            
            // Save list into db
            $this->saveEntity($listMember);
        } catch (Exception $exception) {
            // Return error response if something goes wrong
            return $this->errorResponse(['message' => $exception->getMessage()]);
        }

        return $this->successfulResponse($list->toArray());
    }

    /**
     * Remove MailChimp list.
     *
     * @param string $listMemberId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(string $listMemberId): JsonResponse
    {
        /** @var \App\Database\Entities\MailChimp\MailChimpListMember|null $list */
        $listMember = $this->entityManager->getRepository(MailChimpListMember::class)->find($listMemberId);

        if ($listMember === null) {
            return $this->errorResponse(
                ['message' => \sprintf('MailChimpListMember[%s] not found', $listMemberId)],
                404
            );
        }

        try {
        	//email subscriber hash
        	$subscriber_hash = md5(strtolower($listMember->getEmailAddress()));
            
            // Remove list from MailChimp
            $this->mailChimp->delete(
            	"lists/{$listMember->getMailChimpListId()}/members/{$subscriber_hash}", 
            	$listMember->toMailChimpArray()
            );

            // Remove list from database
            $this->removeEntity($listMember);
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()]);
        }

        return $this->successfulResponse(['result' => "success"]);
    }

    /**
     * Retrieve and return MailChimp list.
     *
     * @param string $listMemberId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $listMemberId): JsonResponse
    {
        /** @var \App\Database\Entities\MailChimp\MailChimpList|null $list */
        $listMember = $this->entityManager->getRepository(MailChimpListMember::class)->find($listMemberId);

        if ($listMember === null) {
            return $this->errorResponse(
                ['message' => \sprintf('MailChimpList[%s] not found', $listMemberId)],
                404
            );
        }

        return $this->successfulResponse($listMember->toArray());
    }

    /**
     * Update MailChimp list.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $listMemberId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $listMemberId): JsonResponse
    {
        /** @var \App\Database\Entities\MailChimp\MailChimpListMember|null $list */
        $listMember = $this->entityManager->getRepository(MailChimpListMember::class)->find($listMemberId);

        if ($listMember === null) {
            return $this->errorResponse(
                ['message' => \sprintf('MailChimpListMember[%s] not found', $listMemberId)],
                404
            );
        }

        $existingEmail = $listMember->getEmailAddress();

        // Update list properties
        $listMember->fill($request->all());

        // Validate entity
        $validator = $this->getValidationFactory()->make($listMember->toMailChimpArray(), $listMember->getValidationRules());

        if ($validator->fails()) {
            // Return error response if validation failed
            return $this->errorResponse([
                'message' => 'Invalid data given',
                'errors' => $validator->errors()->toArray()
            ]);
        }

        try {
            //email subscriber hash
        	$subscriberHash = md5(strtolower($listMember->getEmailAddress()));
        	//email subscriber hash
        	$existingSubscriberEmailHash = md5(strtolower($existingEmail));

            // Update list into MailChimp
            $this->mailChimp->put(
            	"lists/{$listMember->getMailChimpListId()}/members/{$subscriberHash}", 
            	$listMember->toMailChimpArray()
            );

            // Update list into database
            $this->saveEntity($listMember);

            //delete orphan email subscriber
            if($subscriberHash !== $existingSubscriberEmailHash){
            	$this->mailChimp->delete(
	            	"lists/{$listMember->getMailChimpListId()}/members/{$existingSubscriberEmailHash}", 
	            	$listMember->toMailChimpArray()
	            );
            }
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => $exception->getMessage()]);
        }

        return $this->successfulResponse($listMember->toArray());
    }
}
