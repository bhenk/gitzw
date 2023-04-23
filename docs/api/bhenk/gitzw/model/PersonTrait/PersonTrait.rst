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

.. _bhenk\gitzw\model\PersonTrait:

PersonTrait
===========

.. table::
   :widths: auto
   :align: left

   ========== =================== 
   namespace  bhenk\\gitzw\\model 
   predicates Trait               
   ========== =================== 


.. contents::


----


.. _bhenk\gitzw\model\PersonTrait::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\PersonTrait::initPersonTrait:

PersonTrait::initPersonTrait
----------------------------

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


.. _bhenk\gitzw\model\PersonTrait::setCRID:

PersonTrait::setCRID
--------------------

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


.. _bhenk\gitzw\model\PersonTrait::setFirstname:

PersonTrait::setFirstname
-------------------------

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


.. _bhenk\gitzw\model\PersonTrait::setPrefixes:

PersonTrait::setPrefixes
------------------------

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


.. _bhenk\gitzw\model\PersonTrait::setLastname:

PersonTrait::setLastname
------------------------

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


.. _bhenk\gitzw\model\PersonTrait::setDescription:

PersonTrait::setDescription
---------------------------

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


.. _bhenk\gitzw\model\PersonTrait::setUrl:

PersonTrait::setUrl
-------------------

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


.. _bhenk\gitzw\model\PersonTrait::setSameAs:

PersonTrait::setSameAs
----------------------

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


.. _bhenk\gitzw\model\PersonTrait::getSDCard:

PersonTrait::getSDCard
----------------------

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


.. _bhenk\gitzw\model\PersonTrait::getStructuredData:

PersonTrait::getStructuredData
------------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getCRID:

PersonTrait::getCRID
--------------------

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


.. _bhenk\gitzw\model\PersonTrait::getUrl:

PersonTrait::getUrl
-------------------

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


.. _bhenk\gitzw\model\PersonTrait::getFullName:

PersonTrait::getFullName
------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getFirstname:

PersonTrait::getFirstname
-------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getPrefixes:

PersonTrait::getPrefixes
------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getLastname:

PersonTrait::getLastname
------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getDescription:

PersonTrait::getDescription
---------------------------

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


.. _bhenk\gitzw\model\PersonTrait::getSameAs:

PersonTrait::getSameAs
----------------------

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


.. _bhenk\gitzw\model\PersonTrait::getStructuredDataShort:

PersonTrait::getStructuredDataShort
-----------------------------------

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
