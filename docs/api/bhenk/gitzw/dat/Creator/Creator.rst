.. required styles !!
.. raw:: html

    <style> .block {color:lightgrey; font-size: 0.6em; display: block; align-items: center; background-color:black; width:8em; height:8em;padding-left:7px;} </style>
    <style> .tag0 {color:grey; font-size: 0.9em; font-family: "Courier New", monospace;} </style>
    <style> .tag3 {color:grey; font-size: 0.9em; display: inline-block; width:3.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag4 {color:grey; font-size: 0.9em; display: inline-block; width:4.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag5 {color:grey; font-size: 0.9em; display: inline-block; width:5.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag6 {color:grey; font-size: 0.9em; display: inline-block; width:6.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag7 {color:grey; font-size: 0.9em; display: inline-block; width:7.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag8 {color:grey; font-size: 0.9em; display: inline-block; width:8.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag9 {color:grey; font-size: 0.9em; display: inline-block; width:9.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag10 {color:grey; font-size: 0.9em; display: inline-block; width:10.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag11 {color:grey; font-size: 0.9em; display: inline-block; width:11.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag12 {color:grey; font-size: 0.9em; display: inline-block; width:12.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tagsign {color:grey; font-size: 0.9em; display: inline-block; width:3.2em;} </style>
    <style> .param {color:#005858; background-color:#F8F8F8; font-size: 0.8em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>
    <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. end required styles

.. required roles !!
.. role:: block
.. role:: tag0
.. role:: tag3
.. role:: tag4
.. role:: tag5
.. role:: tag6
.. role:: tag7
.. role:: tag8
.. role:: tag9
.. role:: tag10
.. role:: tag11
.. role:: tag12
.. role:: tagsign
.. role:: param
.. role:: tech

.. end required roles

.. _bhenk\gitzw\dat\Creator:

Creator
=======

.. table::
   :widths: auto
   :align: left

   ========== ============================================================================================ 
   namespace  bhenk\\gitzw\\dat                                                                            
   predicates Cloneable | Instantiable                                                                     
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface` | :ref:`bhenk\gitzw\model\JsonAwareInterface` 
   uses       :ref:`bhenk\gitzw\model\PersonTrait`                                                         
   ========== ============================================================================================ 


.. contents::


----


.. _bhenk\gitzw\dat\Creator::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\Creator::__construct:

Creator::__construct
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> bhenk\gitzw\dao\CreatorDo $creatorDo = new \bhenk\gitzw\dao\CreatorDo() ]
    )


| :tag5:`param` :ref:`bhenk\gitzw\dao\CreatorDo` :param:`$creatorDo`


----


.. _bhenk\gitzw\dat\Creator::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\Creator::deserialize:

Creator::deserialize
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================== 
   predicates public | static                                          
   implements :ref:`bhenk\gitzw\model\JsonAwareInterface::deserialize` 
   ========== ======================================================== 





.. code-block:: php

   public static function deserialize(
         Parameter #0 [ <required> string $serialized ]
    ): Creator


| :tag6:`param` string :param:`$serialized`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator`
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dat\Creator::serialize:

Creator::serialize
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\JsonAwareInterface::serialize` 
   ========== ====================================================== 


.. code-block:: php

   public function serialize(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Creator::getID:

Creator::getID
--------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface::getID` 
   ========== ===================================================== 


.. code-block:: php

   public function getID(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dat\Creator::getCreatorDo:

Creator::getCreatorDo
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCreatorDo(): CreatorDo


| :tag6:`return` :ref:`bhenk\gitzw\dao\CreatorDo`


----


.. _bhenk\gitzw\dat\Creator::getWorks:

Creator::getWorks
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get Works by this Creator**


.. code-block:: php

   public function getWorks(
         Parameter #0 [ <optional> int $offset = 0 ]
         Parameter #1 [ <optional> int $limit = bhenk\gitzw\dat\PHP_INT_MAX ]
    ): array


| :tag6:`param` int :param:`$offset` - start index
| :tag6:`param` int :param:`$limit` - max number of Works to return
| :tag6:`return` array  - Work> array of Works or empty array if end of storage reached
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Creator::initPersonTrait:

Creator::initPersonTrait
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initPersonTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\PersonInterface $person ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\PersonInterface` :param:`$person`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setCRID:

Creator::setCRID
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCRID(
         Parameter #0 [ <required> ?string $CRID ]
    ): void


| :tag6:`param` ?\ string :param:`$CRID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setFirstname:

Creator::setFirstname
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setFirstname(
         Parameter #0 [ <required> ?string $firstname ]
    ): void


| :tag6:`param` ?\ string :param:`$firstname`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setPrefixes:

Creator::setPrefixes
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setPrefixes(
         Parameter #0 [ <required> ?string $prefixes ]
    ): void


| :tag6:`param` ?\ string :param:`$prefixes`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setLastname:

Creator::setLastname
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setLastname(
         Parameter #0 [ <required> ?string $lastname ]
    ): void


| :tag6:`param` ?\ string :param:`$lastname`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setDescription:

Creator::setDescription
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setDescription(
         Parameter #0 [ <required> ?string $description ]
    ): void


| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setUrl:

Creator::setUrl
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setUrl(
         Parameter #0 [ <required> ?string $url ]
    ): void


| :tag6:`param` ?\ string :param:`$url`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::setSameAs:

Creator::setSameAs
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setSameAs(
         Parameter #0 [ <required> array $sameAs ]
    ): void


| :tag6:`param` array :param:`$sameAs`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Creator::getSDCard:

Creator::getSDCard
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Gets the SD-Card of this Person**



..  code-block::

   {
       "@context": "http://schema.org",
       "@graph": [
           {
               "@type": "Person",
               "@id": "{CRID}",
               "url": "{url}",
               "name": "{fullName}",
               "description": "{description}",
               "sameAs": [
                   "{sameAs}"
               ]
           }
       ]
   }





.. code-block:: php

   public function getSDCard(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Creator::getStructuredData:

Creator::getStructuredData
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getStructuredData(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\dat\Creator::getCRID:

Creator::getCRID
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCRID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getUrl:

Creator::getUrl
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getUrl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getFullName:

Creator::getFullName
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getFullName(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Creator::getFirstname:

Creator::getFirstname
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getFirstname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getPrefixes:

Creator::getPrefixes
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getPrefixes(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getLastname:

Creator::getLastname
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getLastname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getDescription:

Creator::getDescription
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getDescription(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Creator::getSameAs:

Creator::getSameAs
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getSameAs(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\dat\Creator::getStructuredDataShort:

Creator::getStructuredDataShort
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getStructuredDataShort(): array


| :tag6:`return` array


----

:block:`no datestamp` 
