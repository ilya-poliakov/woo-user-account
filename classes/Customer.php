<?php
/**
 * Created by PhpStorm.
 * User: SP
 * Date: 28.12.2018
 * Time: 11:28
 */

namespace plugins\WooUserAccount\classes;

use plugins\WooUserAccount\classes\base\Base;
use WC_Meta_Data;

/**
 * Class Customer
 *
 * @property \WC_Customer wooCustomer
 * @property string name
 * @property string firstName
 * @property string lastName
 * @property string state
 * @property string city
 * @property string country
 * @property string countryCode
 * @property string address1
 * @property string address2
 * @property string displayName
 * @property string phone
 * @property string bonusesHtml
 * @property int bonuses
 * @property string email
 * @property string addressLine
 * @property string birthDate
 * @package plugins\NovaPoshta\classes
 */
class Customer extends Base
{
    /**
     * @var Customer
     */
    private static $_instance;

    /**
     * @return Customer
     */
    public static function instance()
    {
        if (static::$_instance == null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getMetadata($key)
    {
        if (method_exists($this->wooCustomer, 'get_meta_data')) {
            $data = $this->wooCustomer->get_meta_data();
            /** @var WC_Meta_Data $item */
            foreach ($data as $item) {
                $itemData = $item->get_data();
                if ($itemData['key'] === $key) {
                    return $itemData['value'];
                }
            }
            return '';
        } else {
            //for backward compatibility with woocommerce 2.x.x
            return $this->wooCustomer->$key;
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setMetadata($key, $value)
    {
        update_user_meta($this->wooCustomer->get_id(), $key, $value);

    }

    /**
     * @return \WC_Customer
     */
    protected function getWooCustomer()
    {
        return WC()->customer;
    }

    /**
     * @return string name
     */
    protected function getName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @return string firstName
     */
    protected function getFirstName()
    {
        return $this->wooCustomer->get_billing_first_name();
    }

    /**
     * @return string lastName
     */
    protected function getLastName()
    {
        return $this->wooCustomer->get_billing_last_name();
    }

    /**
     * @return string state
     */
    protected function getState()
    {
        return $this->wooCustomer->get_billing_state();
    }

    /**
     * @return string city
     */
    protected function getCity()
    {
        return $this->wooCustomer->get_billing_city();
    }

    /**
     * @return string countryCode
     */
    protected function getCountry()
    {
        return WC()->countries->countries[$this->countryCode];
    }

    /**
     * @return string address1
     */
    protected function getAddress1()
    {
        return $this->wooCustomer->get_billing_address_1();
    }

    /**
     * @return string address2
     */
    protected function getAddress2()
    {
        return $this->wooCustomer->get_billing_address_2() ;
    }

    /**
     * @return string countryCode
     */
    protected function getCountryCode()
    {
        return $this->wooCustomer->get_billing_country();
    }


    /**
     * @return string displayName
     */
    protected function getDisplayName()
    {
        return $this->wooCustomer->get_display_name();
    }

    /**
     * @return string phone
     */
    protected function getPhone()
    {
        return $this->wooCustomer->get_billing_phone();
    }

    /**
     * @return string bonusesHtml
     */
    protected function getBonusesHtml()
    {
        return $this->bonuses.' $';
    }

    /**
     * @return int bonuses
     */
    protected function getBonuses()
    {
        return $this->getMetadata('bonuses');
    }

    /**
     * @return string email
     */
    protected function getEmail()
    {
        return $this->wooCustomer->get_email();
    }

    /**
     * @return string addressLine
     */
    protected function getAddressLine()
    {
        $addressElements = [];
        if($this->country) $addressElements[] = $this->country;
        if($this->state) $addressElements[] = $this->state.' обл.';
        if($this->city) $addressElements[] = 'г. '.$this->city;
        if($this->wooCustomer->get_billing_address()) $addressElements[] = $this->wooCustomer->get_billing_address();
        return implode(', ', $addressElements);
    }

    /**
     * @return string birthDate
     */
    protected function getBirthDate()
    {
        return $this->getMetadata('birthday');
    }


}
