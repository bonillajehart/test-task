<?php
declare(strict_types=1);

namespace App\Database\Entities\MailChimp;

use Doctrine\ORM\Mapping as ORM;
use EoneoPay\Utils\Str;

/**
 * @ORM\Entity()
 */
class MailChimpListMember extends MailChimpEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $memberId;

    /**
     * @ORM\Column(name="mail_chimp_id", type="string", nullable=true)
     *
     * @var string
     */
    private $mailChimpId;

    /**
     * @ORM\Column(name="mail_chimp_list_id", type="string", nullable=true)
     *
     * @var string
     */
    private $mailChimpListId;

	/**
     * @ORM\Column(name="email_addess", type="string")
     *
     * @var string
     */
    private $emailAddress;

    /**
     * @ORM\Column(name="email_type", type="string", nullable=true)
     *
     * @var string
     */
    private $emailType;

    /**
     * @ORM\Column(name="status", type="string")
     *
     * @var string
     */
    private $status;

    /**
     * @ORM\Column(name="merge_fields", type="array", nullable=true)
     *
     * @var array
     */
    private $mergeFields = null;

	/**
     * @ORM\Column(name="interests", type="array", nullable=true)
     *
     * @var array
     */
    private $interests = null;

    /**
     * @ORM\Column(name="language", type="string", nullable=true)
     *
     * @var string
     */
    private $language;

	/**
     * @ORM\Column(name="vip", type="boolean", nullable=true)
     *
     * @var boolean
     */
    private $vip = false;

	/**
     * @ORM\Column(name="location", type="array", nullable=true)
     *
     * @var array
     */
    private $location = null;

    /**
     * @ORM\Column(name="marketing_permissions", type="array", nullable=true)
     *
     * @var array
     */
    private $marketingPermissions;

    /**
     * @ORM\Column(name="ip_signup", type="string", nullable=true)
     *
     * @var string
     */
    private $ipSignUp;

    /**
     * @ORM\Column(name="timestamp_signup", type="string", nullable=true)
     *
     * @var string
     */
    private $timestampSignUp;

    /**
     * @ORM\Column(name="ip_opt", type="string", nullable=true)
     *
     * @var string
     */
    private $ipOpt;

    /**
     * @ORM\Column(name="timestamp_opt", type="string", nullable=true)
     *
     * @var string
     */
    private $timestampOpt;

    /**
     * @ORM\Column(name="tags", type="array", nullable=true)
     *
     * @var array
     */
    private $tags;

    /**
     * Get id.
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->memberId;
    }


    /**
    * get the id from mail chimp
    *
    * @return null|string
    */
    public function getMailChimpId() : ?string 
    {
        return $this->mailChimpId;
    }
    
    /**
    * set the id retrieved from mail chimp
    *
    * @return MailChimpListMember
    */
    public function setMailChimpId($mailChimpId) : MailChimpListMember 
    {
        $this->mailChimpId = $mailChimpId;
        return $this;
    }


    /**
    * get list id from mailchimp
    *
    * @return null|string
    */
    public function getMailChimpListId() : ?string 
    {
        return $this->mailChimpListId;
    }
    
    /**
    * set list id retrived from mailchimp
    *
    * @return MailChimpListMember
    */
    public function setMailChimpListId($mailChimpListId) : MailChimpListMember 
    {
        $this->mailChimpListId = $mailChimpListId;
        return $this;
    }


    /**
    * get email address
    *
    * @return string
    */
    public function getEmailAddress() : string 
    {
        return $this->emailAddress;
    }
    
    /**
    * set email address
    *
    * @return MailChimpListMember
    */
    public function setEmailAddress($emailAddress) : MailChimpListMember 
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }


    /**
    * get email type
    *
    * @return null|string
    */
    public function getEmailType() : ?string 
    {
        return $this->emailType;
    }
    
    /**
    * set email type
    *
    * @return MailChimpListMember
    */
    public function setEmailType($emailType) : MailChimpListMember 
    {
        $this->emailType = $emailType;
        return $this;
    }


    /**
    * get status
    *
    * @return string
    */
    public function getStatus() : string 
    {
        return $this->status;
    }
    
    /**
    * set status
    *
    * @return MailChimpListMember
    */
    public function setStatus($status) : MailChimpListMember 
    {
        $this->status = $status;
        return $this;
    }


    /**
    * get mergefields
    *
    * @return null|array
    */
    public function getMergeFields() : ?array 
    {
        return $this->mergeFields;
    }
    
    /**
    * set mergefields
    *
    * @return MailChimpListMember
    */
    public function setMergeFields(array $mergeFields) : MailChimpListMember 
    {
        $this->mergeFields = $mergeFields;
        return $this;
    }


    /**
    * get interests
    *
    * @return null|array
    */
    public function getInterests() : ?array 
    {
        return $this->interests;
    }
    
    /**
    * set interests
    *
    * @return MailChimpListMember
    */
    public function setInterests(array $interests) : MailChimpListMember 
    {
        $this->interests = $interests;
        return $this;
    }


    /**
    * get language
    *
    * @return null|string
    */
    public function getLanguage() : ?string 
    {
        return $this->language;
    }
    
    /**
    * set language
    *
    * @return MailChimpListMember
    */
    public function setLanguage(string $language) : MailChimpListMember 
    {
        $this->language = $language;
        return $this;
    }


    /**
    * get vip
    *
    * @return bool
    */
    public function getVip() : bool 
    {
        return $this->vip;
    }
    
    /**
    * set vip
    *
    * @return MailChimpListMember
    */
    public function setVip(bool $vip) : MailChimpListMember 
    {
        $this->vip = $vip;
        return $this;
    }


    /**
    * get location
    *
    * @return null|array
    */
    public function getLocation() : ?array 
    {
        return $this->location;
    }
    
    /**
    * set location
    *
    * @return MailChimpListMember
    */
    public function setLocation(array $location) : MailChimpListMember 
    {
        $this->location = $location;
        return $this;
    }


    /**
    * get marketing permissions
    *
    * @return null|array
    */
    public function getMarketingPermissions() : ?array 
    {
        return $this->marketingPermissions;
    }
    
    /**
    * set marketing permissions
    *
    * @return MailChimpListMember
    */
    public function setMarketingPermissions(array $marketingPermissions) : MailChimpListMember 
    {
        $this->marketingPermissions = $marketingPermissions;
        return $this;
    }


    /**
    * get ip sign up
    *
    * @return null|string
    */
    public function getIpSignUp() : ?string 
    {
        return $this->ipSignUp;
    }
    
    /**
    * set ip sign up
    *
    * @return MailChimpListMember
    */
    public function setIpSignUp(string $ipSignUp) : MailChimpListMember 
    {
        $this->ipSignUp = $ipSignUp;
        return $this;
    }


    /**
    * get timpestamp sign up
    *
    * @return null|string
    */
    public function getTimestampSignUp() : ?string 
    {
        return $this->timestampSignUp;
    }
    
    /**
    * set timestamp sign up
    *
    * @return MailChimpListMember
    */
    public function setTimestampSignUp(string $timestampSignUp) : MailChimpListMember 
    {
        $this->timestampSignUp = $timestampSignUp;
        return $this;
    }


    /**
    * get ip opt
    *
    * @return null|string
    */
    public function getIpOpt() : ?string 
    {
        return $this->ipOpt;
    }
    
    /**
    * set ip opt
    *
    * @return MailChimpListMember
    */
    public function setIpOpt(string $ipOpt) : MailChimpListMember 
    {
        $this->ipOpt = $ipOpt;
        return $this;
    }


    /**
    * get timestamp Opt
    *
    * @return null|string
    */
    public function getTimestampOpt() : ?string 
    {
        return $this->timestampOpt;
    }
    
    /**
    * set timestamp opt
    *
    * @return MailChimpListMember
    */
    public function setTimestampOpt(string $timestampOpt) : MailChimpListMember 
    {
        $this->timestampOpt = $timestampOpt;
        return $this;
    }


    /**
    * get tags
    *
    * @return null|array
    */
    public function getTags() : ?array 
    {
        return $this->tags;
    }
    
    /**
    * set tags
    *
    * @return MailChimpListMember
    */
    public function setTags(array $tags) : MailChimpListMember 
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get validation rules for mailchimp entity.
     *
     * @return array
     */
    public function getValidationRules(): array
    {
        return [
            'email_address' => 'required|string|email',
            'email_type' => 'nullable|string',
            'status' => 'required|string|in:subscribed,unsubscribed,cleaned,pending',
            'merge_fields.FNAME' => 'nullable|string',
            'merge_fields.LNAME' => 'nullable|string',
            'merge_fields.ADDRESS' => 'nullable|string',
            'merge_fields.PHONE' => 'nullable|string',
            'language' => 'nullable|string',
            'vip' => 'nullable|boolean',
            'location.latitude' => 'nullable|numeric',
            'location.longitude' => 'nullable|numeric',
            'marketing_permissions.marketing_permission_id' => 'nullable|string',
            'marketing_permissions.enabled' => 'nullable|boolean',
            'ip_signup' => 'nullable|string',
            'timestamp_signup' => 'nullable|string',
            'ip_opt' => 'nullable|string',
            'timestamp_opt' => 'nullable|string',
        ];
    }

    /**
     * Get array representation of entity.
     * @todo refactor
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        $str = new Str();

        foreach (\get_object_vars($this) as $property => $value) {
            $array[$str->snake($property)] = $value;
        }

        return $array;
    }
}
