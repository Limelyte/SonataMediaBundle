CHANGELOG
=========

A [BC BREAK] means the update will break the project for many reasons:

* new mandatory configuration
* new dependencies
* class refactoring

### 2014-01-05
* [BC BREAK] The method signature for Sonata\MediaBundle\Model\MediaManagerInterface has changed from:

  ```php
  public function save(MediaInterface $media, $context = null, $providerName = null)
  ```

  to

  ```php
  public function save(MediaInterface $media, $andFlush = true)
  ```

  This change was due to the logic not really being needed in the class since you can achieve
  the same thing via setter methods

### 2013-12-16

* GalleryManager & MediaManager now extend DoctrineBaseManager from SonataCoreBundle.
* GalleryManager::update() is now deprecated, please use save() instead.

### 2013-09-16

* YouTube videos can now be inserted in HTML5. 

  Add in your config.yml:
  ```yaml 
  sonata_media:
      providers:
          youtube:
              html5: true #default value is false
  ```

### 2012-10-29

* [BC BREAK] The provider metadata field now uses the "json" type from sonata-project/doctrine-extensions

  Use the Migrate command to change old provider metadata fields into json:

  app/console sonata:media:migrate-json --table=media__media
