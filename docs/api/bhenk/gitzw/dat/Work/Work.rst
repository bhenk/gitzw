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

.. _bhenk\gitzw\dat\Work:

Work
====

.. table::
   :widths: auto
   :align: left

   ========== ================================================================================================================================ 
   namespace  bhenk\\gitzw\\dat                                                                                                                
   predicates Cloneable | Instantiable                                                                                                         
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface` | :ref:`bhenk\gitzw\model\JsonAwareInterface`                                     
   uses       :ref:`bhenk\gitzw\model\MultiLanguageTitleTrait` | :ref:`bhenk\gitzw\model\DimensionsTrait` | :ref:`bhenk\gitzw\model\DateTrait` 
   ========== ================================================================================================================================ 


**A Work in gitzwart is something that can be represented by one or more images aka Representations**


.. contents::


----


.. _bhenk\gitzw\dat\Work::Constants:

Constants
+++++++++


.. _bhenk\gitzw\dat\Work::LANGUAGES:

Work::LANGUAGES
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   array(2) { [0]=> string(2) "nl" [1]=> string(2) "en" } 




----


.. _bhenk\gitzw\dat\Work::CM_TO_IN:

Work::CM_TO_IN
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   float(2.54) 




----


.. _bhenk\gitzw\dat\Work::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\Work::__construct:

Work::__construct
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> bhenk\gitzw\dao\WorkDo $workDo = new \bhenk\gitzw\dao\WorkDo() ]
         Parameter #1 [ <optional> ?array $representationRelations = NULL ]
    )


| :tag5:`param` :ref:`bhenk\gitzw\dao\WorkDo` :param:`$workDo`
| :tag5:`param` ?\ array :param:`$representationRelations`


----


.. _bhenk\gitzw\dat\Work::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\Work::getID:

Work::getID
-----------

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


.. _bhenk\gitzw\dat\Work::deserialize:

Work::deserialize
-----------------

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
    ): Work


| :tag6:`param` string :param:`$serialized`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Work`
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dat\Work::serialize:

Work::serialize
---------------

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
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Work::getRelations:

Work::getRelations
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getRelations(): WorkRelations


| :tag6:`return` :ref:`bhenk\gitzw\dat\WorkRelations`


----


.. _bhenk\gitzw\dat\Work::getRESID:

Work::getRESID
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getRESID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Work::setRESID:

Work::setRESID
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setRESID(
         Parameter #0 [ <required> string $RESID ]
    ): void


| :tag6:`param` string :param:`$RESID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getMedia:

Work::getMedia
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getMedia(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Work::setMedia:

Work::setMedia
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setMedia(
         Parameter #0 [ <required> string $media ]
    ): void


| :tag6:`param` string :param:`$media`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::isHidden:

Work::isHidden
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isHidden(): bool


| :tag6:`return` bool


----


.. _bhenk\gitzw\dat\Work::setHidden:

Work::setHidden
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setHidden(
         Parameter #0 [ <required> bool $hidden ]
    ): void


| :tag6:`param` bool :param:`$hidden`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getOrdinal:

Work::getOrdinal
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getOrdinal(): int


| :tag6:`return` int


----


.. _bhenk\gitzw\dat\Work::setOrdinal:

Work::setOrdinal
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setOrdinal(
         Parameter #0 [ <required> int $ordinal ]
    ): void


| :tag6:`param` int :param:`$ordinal`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getCategory:

Work::getCategory
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCategory(): ?WorkCategories


| :tag6:`return` ?\ :ref:`bhenk\gitzw\model\WorkCategories`


----


.. _bhenk\gitzw\dat\Work::setCategory:

Work::setCategory
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCategory(
         Parameter #0 [ <required> bhenk\gitzw\model\WorkCategories|string $category ]
    ): bool


| :tag6:`param` :ref:`bhenk\gitzw\model\WorkCategories` | string :param:`$category`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dat\Work::setCreator:

Work::setCreator
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCreator(
         Parameter #0 [ <required> bhenk\gitzw\dat\Creator|string|int|null $creator ]
    ): Creator|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Creator` | string | int | null :param:`$creator`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Work::getCreator:

Work::getCreator
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCreator(): Creator|bool


| :tag6:`return` :ref:`bhenk\gitzw\dat\Creator` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\Work::unsetCreator:

Work::unsetCreator
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function unsetCreator(): void


| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getTypes:

Work::getTypes
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTypes(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\dat\Work::setTypes:

Work::setTypes
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTypes(
         Parameter #0 [ <required> array $types ]
    ): void


| :tag6:`param` array :param:`$types`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getWorkDo:

Work::getWorkDo
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getWorkDo(): WorkDo


| :tag6:`return` :ref:`bhenk\gitzw\dao\WorkDo`


----


.. _bhenk\gitzw\dat\Work::initTitleTrait:

Work::initTitleTrait
--------------------

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


.. _bhenk\gitzw\dat\Work::setTitleEn:

Work::setTitleEn
----------------

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


.. _bhenk\gitzw\dat\Work::setTitleNl:

Work::setTitleNl
----------------

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


.. _bhenk\gitzw\dat\Work::setPreferredLanguage:

Work::setPreferredLanguage
--------------------------

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


.. _bhenk\gitzw\dat\Work::getPreferredTitle:

Work::getPreferredTitle
-----------------------

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


.. _bhenk\gitzw\dat\Work::getPreferredLanguage:

Work::getPreferredLanguage
--------------------------

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


.. _bhenk\gitzw\dat\Work::getTitleEn:

Work::getTitleEn
----------------

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


.. _bhenk\gitzw\dat\Work::getTitleNl:

Work::getTitleNl
----------------

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


.. _bhenk\gitzw\dat\Work::getTitles:

Work::getTitles
---------------

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


.. _bhenk\gitzw\dat\Work::initDimensionsTrait:

Work::initDimensionsTrait
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function initDimensionsTrait(
         Parameter #0 [ <required> bhenk\gitzw\model\DimensionsInterface $dimensions ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\model\DimensionsInterface` :param:`$dimensions`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::setDimensions:

Work::setDimensions
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDimensions(
         Parameter #0 [ <optional> float $w = -1.0 ]
         Parameter #1 [ <optional> float $h = -1.0 ]
         Parameter #2 [ <optional> float $d = -1.0 ]
    ): void


| :tag6:`param` float :param:`$w`
| :tag6:`param` float :param:`$h`
| :tag6:`param` float :param:`$d`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::setWidth:

Work::setWidth
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setWidth(
         Parameter #0 [ <required> float $width ]
    ): void


| :tag6:`param` float :param:`$width`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::setHeight:

Work::setHeight
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setHeight(
         Parameter #0 [ <required> float $height ]
    ): void


| :tag6:`param` float :param:`$height`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::setDepth:

Work::setDepth
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDepth(
         Parameter #0 [ <required> float $depth ]
    ): void


| :tag6:`param` float :param:`$depth`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::getDimensions:

Work::getDimensions
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDimensions(
         Parameter #0 [ <optional> int $decCm = 0 ]
         Parameter #1 [ <optional> int $decIn = 1 ]
    ): string


| :tag6:`param` int :param:`$decCm`
| :tag6:`param` int :param:`$decIn`
| :tag6:`return` string


----


.. _bhenk\gitzw\dat\Work::getWidth:

Work::getWidth
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getWidth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dat\Work::getHeight:

Work::getHeight
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getHeight(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dat\Work::getDepth:

Work::getDepth
--------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDepth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dat\Work::getDimExtra:

Work::getDimExtra
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDimExtra(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Work::setDimExtra:

Work::setDimExtra
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDimExtra(
         Parameter #0 [ <required> ?string $extra ]
    ): void


| :tag6:`param` ?\ string :param:`$extra`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Work::initDateTrait:

Work::initDateTrait
-------------------

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


.. _bhenk\gitzw\dat\Work::getDate:

Work::getDate
-------------

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


.. _bhenk\gitzw\dat\Work::setDate:

Work::setDate
-------------

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


.. _bhenk\gitzw\dat\Work::rearrangeDate:

Work::rearrangeDate
-------------------

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
