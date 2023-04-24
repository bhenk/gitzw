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

.. _bhenk\gitzw\dat\Exhibition:

Exhibition
==========

.. table::
   :widths: auto
   :align: left

   ========== ============================================================================================ 
   namespace  bhenk\\gitzw\\dat                                                                            
   predicates Cloneable | Instantiable                                                                     
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface` | :ref:`bhenk\gitzw\model\JsonAwareInterface` 
   uses       :ref:`bhenk\gitzw\model\MultiLanguageTitleTrait` | :ref:`bhenk\gitzw\model\DateTrait`        
   ========== ============================================================================================ 


.. contents::


----


.. _bhenk\gitzw\dat\Exhibition::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\Exhibition::LANGUAGES:

Exhibition::LANGUAGES
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   array(2) { [0]=> string(2) "nl" [1]=> string(2) "en" } 




----


.. _bhenk\gitzw\dat\Exhibition::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\Exhibition::__construct:

Exhibition::__construct
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> bhenk\gitzw\dao\ExhibitionDo $exhibitionDo = new \bhenk\gitzw\dao\ExhibitionDo() ]
         Parameter #1 [ <optional> ?array $workRelations = NULL ]
    )


| :tag5:`param` :ref:`bhenk\gitzw\dao\ExhibitionDo` :param:`$exhibitionDo`
| :tag5:`param` ?\ array :param:`$workRelations`


----


.. _bhenk\gitzw\dat\Exhibition::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\Exhibition::getID:

Exhibition::getID
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface::getID` 
   ========== ===================================================== 






.. admonition:: @inheritdoc

    

   **Get the ID of this JsonAware**
   
   | :tag6:`return` int | null  - ID or *null* if this JsonAware does not have an ID yet
   
   ``@inheritdoc`` from method :ref:`bhenk\gitzw\model\StoredObjectInterface::getID`




.. code-block:: php

   public function getID(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dat\Exhibition::deserialize:

Exhibition::deserialize
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================== 
   predicates public | static                                          
   implements :ref:`bhenk\gitzw\model\JsonAwareInterface::deserialize` 
   ========== ======================================================== 






.. admonition:: @inheritdoc

    

   **Deserialize the object from the given json string**
   
   | :tag6:`param` string :param:`$serialized` - json string
   | :tag6:`return` `JsonAwareInterface <https://www.google.com/search?q=JsonAwareInterface>`_  - rebirth of the serialized object
   
   ``@inheritdoc`` from method :ref:`bhenk\gitzw\model\JsonAwareInterface::deserialize`




.. code-block:: php

   public static function deserialize(
         Parameter #0 [ <required> string $serialized ]
    ): Exhibition


| :tag6:`param` string :param:`$serialized`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Exhibition`
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dat\Exhibition::serialize:

Exhibition::serialize
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\JsonAwareInterface::serialize` 
   ========== ====================================================== 






.. admonition:: @inheritdoc

    

   **Serialize this to a json string**
   
   | :tag6:`return` string  - json string
   
   ``@inheritdoc`` from method :ref:`bhenk\gitzw\model\JsonAwareInterface::serialize`




.. code-block:: php

   public function serialize(): string


| :tag6:`return` string
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Exhibition::getEXHID:

Exhibition::getEXHID
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getEXHID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Exhibition::setEXHID:

Exhibition::setEXHID
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setEXHID(
         Parameter #0 [ <required> string $EXHID ]
    ): void


| :tag6:`param` string :param:`$EXHID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::getDescription:

Exhibition::getDescription
--------------------------

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


.. _bhenk\gitzw\dat\Exhibition::setDescription:

Exhibition::setDescription
--------------------------

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


.. _bhenk\gitzw\dat\Exhibition::getSubtitle:

Exhibition::getSubtitle
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getSubtitle(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Exhibition::setSubtitle:

Exhibition::setSubtitle
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setSubtitle(
         Parameter #0 [ <required> ?string $subtitle ]
    ): void


| :tag6:`param` ?\ string :param:`$subtitle`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::getRelations:

Exhibition::getRelations
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getRelations(): ExhibitionRelations


| :tag6:`return` :ref:`bhenk\gitzw\dat\ExhibitionRelations`


----


.. _bhenk\gitzw\dat\Exhibition::getExhibitionDo:

Exhibition::getExhibitionDo
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getExhibitionDo(): ExhibitionDo


| :tag6:`return` :ref:`bhenk\gitzw\dao\ExhibitionDo`


----


.. _bhenk\gitzw\dat\Exhibition::initTitleTrait:

Exhibition::initTitleTrait
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initTitleTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\MultiLanguageTitleInterface $ml_title ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface` :param:`$ml_title`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::setTitleEn:

Exhibition::setTitleEn
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTitleEn(
         Parameter #0 [ <required> string $title_en ]
    ): void


| :tag6:`param` string :param:`$title_en`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::setTitleNl:

Exhibition::setTitleNl
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTitleNl(
         Parameter #0 [ <required> string $title_nl ]
    ): void


| :tag6:`param` string :param:`$title_nl`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::setPreferredLanguage:

Exhibition::setPreferredLanguage
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setPreferredLanguage(
         Parameter #0 [ <required> string $preferred ]
    ): bool


| :tag6:`param` string :param:`$preferred`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dat\Exhibition::getPreferredTitle:

Exhibition::getPreferredTitle
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getPreferredTitle(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Exhibition::getPreferredLanguage:

Exhibition::getPreferredLanguage
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getPreferredLanguage(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Exhibition::getTitleEn:

Exhibition::getTitleEn
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTitleEn(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Exhibition::getTitleNl:

Exhibition::getTitleNl
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTitleNl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Exhibition::getTitles:

Exhibition::getTitles
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getTitles(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Exhibition::initDateTrait:

Exhibition::initDateTrait
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initDateTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\DateInterface $dateObject ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\DateInterface` :param:`$dateObject`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Exhibition::getDate:

Exhibition::getDate
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the creation date**


Gets the creation date in the original format. If no creation date was set will return
the empty string.



.. code-block:: php

   public function getDate(): string


| :tag6:`return` string  - date in original format or empty string


----


.. _bhenk\gitzw\dat\Exhibition::setDate:

Exhibition::setDate
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDate(
         Parameter #0 [ <required> string $date ]
    ): bool


| :tag6:`param` string :param:`$date`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dat\Exhibition::rearrangeDate:

Exhibition::rearrangeDate
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Rearranges date**


Rearranges *d-m-Y* to *Y-m-d* and *m-Y* to *Y-m*.



.. code-block:: php

   public static function rearrangeDate(
         Parameter #0 [ <required> string $date ]
    ): string|bool


| :tag6:`param` string :param:`$date`
| :tag6:`return` string | bool  - *Y-m-d*, *Y-m* or *Y*, returns *false* if illegible


----

:block:`no datestamp` 
