<?php
/**
 * @author        Toni Uebernickel <toni@uebernickel.info>
 * @link          http://toni.uebernickel.info/
 *
 * @package       wspPingdomPlugin
 * @subpackage    pingdom.lib
 * @version       $Id$
 * @link          $HeadURL$
 */

/**
 * Class that describes notification.
 *
 * @see http://www.pingdom.com/services/api-documentation/class_GetNotificationsResponseItem
 */
class PingdomApiReportGetNotificationsResponseItem
{
  /**
   * Notification time.
   *
   * @var DateTime
   */
  private $notificationTime;

  /**
   * Check name.
   *
   * @var string
   */
  private $check;

  /**
   * Contact name.
   *
   * @var string
   */
  private $contact;

  /**
   * Sent to.
   *
   * @var string
   */
  private $sentTo;

  /**
   * Type of message: ResponseViaEnum
   *
   * @var string
   */
  private $messageType;

  /**
   * Message status: ResponseStatusEnum
   *
   * @var string
   */
  private $messageStatus;

  /**
   * Cause (UP, DOWN, TEST or SYSTEM).
   *
   * @var string
   */
  private $cause;

  /**
   * Message text.
   *
   * @var string
   */
  private $message;

  /**
   * Charged.
   *
   * @var bool
   */
  private $charged;

  public function __construct(stdClass $responseItem)
  {
    if ($this->validate($responseItem))
    {
      $this->notificationTime = new DateTime($responseItem->notificationTime);
      $this->check = $responseItem->check;
      $this->contact = $responseItem->contact;
      $this->sentTo = $responseItem->sentTo;
      $this->messageType = $responseItem->messageType;
      $this->messageStatus = $responseItem->messageStatus;
      $this->cause = $responseItem->cause;
      $this->message = $responseItem->message;
      $this->charged = $responseItem->charged;
    }
    else
    {
      throw new PingdomApiInvalidArgumentException('The given notification response item is invalid.', 9);
    }
  }

  /**
   * Validates the given responseItem
   *
   * @param stdClass $responseItem
   *
   * @return bool
   */
  private function validate(stdClass $responseItem)
  {
    if (empty($responseItem->notificationTime))
    {
      return false;
    }

    if (empty($responseItem->check))
    {
      return false;
    }

    if (empty($responseItem->contact))
    {
      return false;
    }

    if (empty($responseItem->sentTo))
    {
      return false;
    }

    if (empty($responseItem->messageType))
    {
      return false;
    }
    elseif (!in_array($responseItem->messageType, PingdomApiReportViaEnum::getEnum()))
    {
      return false;
    }

    if (empty($responseItem->messageStatus))
    {
      return false;
    }
    elseif (!in_array($responseItem->messageStatus, PingdomApiReportStatusEnum::getEnum()))
    {
      return false;
    }

    if (empty($responseItem->cause))
    {
      return false;
    }
    elseif (!in_array($responseItem->cause, PingdomApiReportCauseEnum::getEnum()))
    {
      return false;
    }

    if (empty($responseItem->message))
    {
      return false;
    }

    if (!is_bool($responseItem->charged))
    {
      return false;
    }

    return true;
  }

  /**
   * Get the check name of this entry.
   *
   * @return string
   */
  public function getCheck()
  {
    return $this->check;
  }

  /**
   * Get the notification time.
   *
   * @return DateTime
   */
  public function getDateTime()
  {
    return $this->dateTime;
  }

  /**
   * Get the contact name.
   *
   * @return string
   */
  public function getContact()
  {
    return $this->contact;
  }

  /**
   * Get the details about to what endpoint the notification was sent.
   * Will be email address or mobile number.
   *
   * @return string
   */
  public function getSentTo()
  {
    return $this->sentTo;
  }

  /**
   * Get the message type sent.
   * Will be a value of PingdomApiReportViaEnum.
   *
   * @return string
   */
  public function getMessageType()
  {
    return $this->messageType;
  }

  /**
   * Get the message status.
   * Will be a value of PingdomApiReportStatusEnum.
   *
   * @return string
   */
  public function getMessageStatus()
  {
    return $this->messageStatus;
  }

  /**
   * Get the cause of the notification.
   * Will be a value of PingdomApiReportCauseEnum.
   *
   * @return string
   */
  public function getCause()
  {
    return $this->cause;
  }

  /**
   * Get the message sent.
   *
   * @return string
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Get a flag whether this notification was charged.
   *
   * @return bool
   */
  public function getCharged()
  {
    return $this->charged;
  }

  /**
   * Get a flag whether this notification was charged.
   *
   * @uses self::getCharged()
   *
   * @return bool
   */
  public function wasCharged()
  {
    return $this->getCharged();
  }
}