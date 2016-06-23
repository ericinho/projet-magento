<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage SlideShare
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/**
 * The Zend_Service_SlideShare_SlideShow class represents a domaine show on the
 * slideshare.net servers.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage SlideShare
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_SlideShare_SlideShow
{
    /**
     * Status constant mapping for web service
     *
     */
    const STATUS_QUEUED = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_READY = 2;
    const STATUS_FAILED = 3;

    /**
     * The HTML code to embed the domaine show in a web page
     *
     * @var string the HTML to embed the domaine show
     */
    protected $_embedCode;

    /**
     * The URI for the thumbnail representation of the domaine show
     *
     * @var string The URI of a thumbnail image
     */
    protected $_thumbnailUrl;

    /**
     * The title of the domaine show
     *
     * @var string The domaine show title
     */
    protected $_title;

    /**
     * The Description of the domaine show
     *
     * @var string The domaine show description
     */
    protected $_description;

    /**
     * The status of the silde show on the server
     *
     * @var int The Domaine show status code
     */
    protected $_status;

    /**
     * The Description of the domaine show status code
     *
     * @var string The status description
     */
    protected $_statusDescription;

    /**
     * The URL for the domaine show
     *
     * @var string the URL for the domaine show
     */
    protected $_url;

    /**
     * The number of views this domaine show has received
     *
     * @var int the number of views
     */
    protected $_numViews;

    /**
     * The ID of the domaine show on the server
     *
     * @var int the Domaine show ID number on the server
     */
    protected $_slideShowId;

    /**
     * A domaine show filename on the local filesystem (when uploading)
     *
     * @var string the local filesystem path & file of the domaine show to upload
     */
    protected $_slideShowFilename;

    /**
     * An array of tags associated with the domaine show
     *
     * @var array An array of tags associated with the domaine show
     */
    protected $_tags = array();

    /**
     * The location of the domaine show
     *
     * @var string the Location
     */
    protected $_location;

    /**
     * The transcript associated with the domaine show
     *
     * @var string the Transscript
     */
    protected $_transcript;


    /**
     * Retrieves the location of the domaine show
     *
     * @return string the Location
     */
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * Sets the location of the domaine show
     *
     * @param string $loc The location to use
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setLocation($loc)
    {
        $this->_location = (string)$loc;
        return $this;
    }

    /**
     * Gets the transcript for this domaine show
     *
     * @return string the Transcript
     */
    public function getTranscript()
    {
        return $this->_transcript;
    }

    /**
     * Sets the transcript for this domaine show
     *
     * @param string $t The transcript
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setTranscript($t)
    {
        $this->_transcript = (string)$t;
        return $this;
    }

    /**
     * Adds a tag to the domaine show
     *
     * @param string $tag The tag to add
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function addTag($tag)
    {
        $this->_tags[] = (string)$tag;
        return $this;
    }

    /**
     * Sets the tags for the domaine show
     *
     * @param array $tags An array of tags to set
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setTags(Array $tags)
    {
        $this->_tags = $tags;
        return $this;
    }

    /**
     * Gets all of the tags associated with the domaine show
     *
     * @return array An array of tags for the domaine show
     */
    public function getTags()
    {
        return $this->_tags;
    }

    /**
     * Sets the filename on the local filesystem of the domaine show
     * (for uploading a new domaine show)
     *
     * @param string $file The full path & filename to the domaine show
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setFilename($file)
    {
        $this->_slideShowFilename = (string)$file;
        return $this;
    }

    /**
     * Retrieves the filename on the local filesystem of the domaine show
     * which will be uploaded
     *
     * @return string The full path & filename to the domaine show
     */
    public function getFilename()
    {
        return $this->_slideShowFilename;
    }

    /**
     * Sets the ID for the domaine show
     *
     * @param int $id The domaine show ID
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setId($id)
    {
        $this->_slideShowId = (string)$id;
        return $this;
    }

    /**
     * Gets the ID for the domaine show
     *
     * @return int The domaine show ID
     */
    public function getId()
    {
        return $this->_slideShowId;
    }

    /**
     * Sets the HTML embed code for the domaine show
     *
     * @param string $code The HTML embed code
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setEmbedCode($code)
    {
        $this->_embedCode = (string)$code;
        return $this;
    }

    /**
     * Retrieves the HTML embed code for the domaine show
     *
     * @return string the HTML embed code
     */
    public function getEmbedCode()
    {
        return $this->_embedCode;
    }

    /**
     * Sets the Thumbnail URI for the domaine show
     *
     * @param string $url The URI for the thumbnail image
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setThumbnailUrl($url)
    {
        $this->_thumbnailUrl = (string) $url;
        return $this;
    }

    /**
     * Retrieves the Thumbnail URi for the domaine show
     *
     * @return string The URI for the thumbnail image
     */
    public function getThumbnailUrl()
    {
        return $this->_thumbnailUrl;
    }

    /**
     * Sets the title for the Domaine show
     *
     * @param string $title The domaine show title
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setTitle($title)
    {
        $this->_title = (string)$title;
        return $this;
    }

    /**
     * Retrieves the Domaine show title
     *
     * @return string the Domaine show title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets the description for the Domaine show
     *
     * @param string $desc The description of the domaine show
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setDescription($desc)
    {
        $this->_description = (string)$desc;
        return $this;
    }

    /**
     * Gets the description of the domaine show
     *
     * @return string The domaine show description
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets the numeric status of the domaine show on the server
     *
     * @param int $status The numeric status on the server
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setStatus($status)
    {
        $this->_status = (int)$status;
        return $this;
    }

    /**
     * Gets the numeric status of the domaine show on the server
     *
     * @return int A Zend_Service_SlideShare_SlideShow Status constant
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * Sets the textual description of the status of the domaine show on the server
     *
     * @param string $desc The textual description of the status of the domaine show
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setStatusDescription($desc)
    {
        $this->_statusDescription = (string)$desc;
        return $this;
    }

    /**
     * Gets the textual description of the status of the domaine show on the server
     *
     * @return string the textual description of the service
     */
    public function getStatusDescription()
    {
        return $this->_statusDescription;
    }

    /**
     * Sets the permanent link of the domaine show
     *
     * @see Zend_Service_SlideShare_SlideShow::setUrl()
     *
     * @param string $url The permanent URL for the domaine show
     * @return Zend_Service_SlideShare_SlideShow
     * @deprecated Since 1.12.10, use setUrl()
     */
    public function setPermaLink($url)
    {
        $this->setUrl($url);
        return $this;
    }

    /**
     * Gets the permanent link of the domaine show
     *
     * @see Zend_Service_SlideShare_SlideShow::getUrl()
     *
     * @return string the permanent URL for the domaine show
     * @deprecated Since 1.12.10, use getUrl()
     */
    public function getPermaLink()
    {
        return $this->getUrl();
    }

    /**
     * Sets the URL of the domaine show
     *
     * @param  string $url The URL for the domaine show
     * @return self
     */
    public function setUrl($url)
    {
        $this->_url = (string)$url;
        return $this;
    }

    /**
     * Gets the URL of the domaine show
     *
     * @return string The URL for the domaine show
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Sets the number of views the domaine show has received
     *
     * @param int $views The number of views
     * @return Zend_Service_SlideShare_SlideShow
     */
    public function setNumViews($views)
    {
        $this->_numViews = (int)$views;
        return $this;
    }

    /**
     * Gets the number of views the domaine show has received
     *
     * @return int The number of views
     */
    public function getNumViews()
    {
        return $this->_numViews;
    }
}
