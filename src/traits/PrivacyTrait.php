<?php

namespace luya\privacy\traits;

use Yii;
use yii\web\Cookie;

/**
 * Trait PrivacyTrait
 *
 * The privacy trait helps getting and setting the privacy policy state.
 * It can be used e.g. inside a widget to check the privacy policies' actual settings and to change these.
 *
 * @author Alex Schmid <alex.schmid@stud.unibas.ch>
 * @since 1.0.0
 */
trait PrivacyTrait
{
    public static $PRIVACY_COOKIE_NAME = '_privacyPolicy';

    /**
     * @return bool|null The privacy value
     *
     * Method to retreive the actual privacy policies' state, e.g. whether a user has accepted or declined these.
     * It returns null if the user has not made any choice at all yet.
     */
    public function getPrivacyCookieValue()
    {
        return Yii::$app->response->cookies->getValue(self::$PRIVACY_COOKIE_NAME, null);
    }

    /**
     * Sets the privacy cookie value
     * If it sets this to true, it will allow cookies, if set to false, it will place a single cookie which tells that
     * a user declined the privacy policies. Therefore no other cookies should be allowed.
     */
    public function setPrivacyCookieValue($value = null)
    {
        Yii::$app->response->cookies->add(new Cookie([
            'name' => self::$PRIVACY_COOKIE_NAME,
            'value' => $value,
        ]));
    }

    /**
     * @return bool Checks whether the privacy is accepted or not
     */
    public function isPrivacyAccepted()
    {
        return $this->getPrivacyCookieValue() === true;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isPrivacyNotDecided()
    {
        return $this->getPrivacyCookieValue() === null;
    }

    /**
     * @return bool Checks whether the privacy is declined or not
     */
    public function isPrivacyDeclined()
    {
        return $this->getPrivacyCookieValue() === false;
    }
}
