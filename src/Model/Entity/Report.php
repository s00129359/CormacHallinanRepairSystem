<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $customer_id
 * @property \App\Model\Entity\Customer $customer
 * @property string $equipment
 * @property string $brand
 * @property string $description
 * @property string $accessories
 * @property string $notes
 * @property bool $priority
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $finished
 * @property string $conclusion
 * @property \Cake\I18n\Time $completed_date
 * @property bool $paid_status
 * @property float $amount_due
 * @property bool $sms_list
 * @property bool $email_list
 * @property \Cake\I18n\Time $smsSendDate
 * @property \Cake\I18n\Time $emailSendDate
 */
class Report extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
