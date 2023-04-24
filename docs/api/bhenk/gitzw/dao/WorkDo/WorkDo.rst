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

.. _bhenk\gitzw\dao\WorkDo:

WorkDo
======

.. table::
   :widths: auto
   :align: left

   ========== ==================================================================================================================================================================================================================================================================== 
   namespace  bhenk\\gitzw\\dao                                                                                                                                                                                                                                                    
   predicates Cloneable | Instantiable                                                                                                                                                                                                                                             
   implements `EntityInterface <http://bhenkmsdata.rtfd.io/>`_ | `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface` | :ref:`bhenk\gitzw\model\DimensionsInterface` | :ref:`bhenk\gitzw\model\DateInterface` 
   extends    `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                                                                                                                                                              
   hierarchy  :ref:`bhenk\gitzw\dao\WorkDo` -> `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                                                                                                                             
   ========== ==================================================================================================================================================================================================================================================================== 


.. contents::


----


.. _bhenk\gitzw\dao\WorkDo::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dao\WorkDo::__construct:

WorkDo::__construct
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?int $ID = NULL ]
         Parameter #1 [ <optional> ?string $RESID = NULL ]
         Parameter #2 [ <optional> ?string $title_en = NULL ]
         Parameter #3 [ <optional> ?string $title_nl = NULL ]
         Parameter #4 [ <optional> ?string $preferred = NULL ]
         Parameter #5 [ <optional> ?string $media = NULL ]
         Parameter #6 [ <optional> float $width = -1.0 ]
         Parameter #7 [ <optional> float $height = -1.0 ]
         Parameter #8 [ <optional> float $depth = -1.0 ]
         Parameter #9 [ <optional> ?string $dim_extra = NULL ]
         Parameter #10 [ <optional> ?string $date = NULL ]
         Parameter #11 [ <optional> ?string $d_format = NULL ]
         Parameter #12 [ <optional> ?bool $hidden = false ]
         Parameter #13 [ <optional> int $ordinal = -1 ]
         Parameter #14 [ <optional> ?string $category = NULL ]
         Parameter #15 [ <optional> ?int $creatorId = NULL ]
         Parameter #16 [ <optional> ?string $types = NULL ]
         Parameter #17 [ <optional> ?string $location = NULL ]
    )


| :tag5:`param` ?\ int :param:`$ID`
| :tag5:`param` ?\ string :param:`$RESID`
| :tag5:`param` ?\ string :param:`$title_en`
| :tag5:`param` ?\ string :param:`$title_nl`
| :tag5:`param` ?\ string :param:`$preferred`
| :tag5:`param` ?\ string :param:`$media`
| :tag5:`param` float :param:`$width`
| :tag5:`param` float :param:`$height`
| :tag5:`param` float :param:`$depth`
| :tag5:`param` ?\ string :param:`$dim_extra`
| :tag5:`param` ?\ string :param:`$date`
| :tag5:`param` ?\ string :param:`$d_format`
| :tag5:`param` ?\ bool :param:`$hidden`
| :tag5:`param` int :param:`$ordinal`
| :tag5:`param` ?\ string :param:`$category`
| :tag5:`param` ?\ int :param:`$creatorId`
| :tag5:`param` ?\ string :param:`$types`
| :tag5:`param` ?\ string :param:`$location`


----


.. _bhenk\gitzw\dao\WorkDo::Methods:

Methods
+++++++


.. _bhenk\gitzw\dao\WorkDo::getRESID:

WorkDo::getRESID
----------------

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


.. _bhenk\gitzw\dao\WorkDo::setRESID:

WorkDo::setRESID
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setRESID(
         Parameter #0 [ <required> ?string $RESID ]
    ): void


| :tag6:`param` ?\ string :param:`$RESID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getTitleEn:

WorkDo::getTitleEn
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::getTitleEn` 
   ========== ================================================================ 





.. code-block:: php

   public function getTitleEn(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setTitleEn:

WorkDo::setTitleEn
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::setTitleEn` 
   ========== ================================================================ 





.. code-block:: php

   public function setTitleEn(
         Parameter #0 [ <required> ?string $title_en ]
    ): void


| :tag6:`param` ?\ string :param:`$title_en`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getTitleNl:

WorkDo::getTitleNl
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::getTitleNl` 
   ========== ================================================================ 





.. code-block:: php

   public function getTitleNl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setTitleNl:

WorkDo::setTitleNl
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::setTitleNl` 
   ========== ================================================================ 





.. code-block:: php

   public function setTitleNl(
         Parameter #0 [ <required> ?string $title_nl ]
    ): void


| :tag6:`param` ?\ string :param:`$title_nl`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getPreferredLanguage:

WorkDo::getPreferredLanguage
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================================================================== 
   predicates public                                                                     
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::getPreferredLanguage` 
   ========== ========================================================================== 





.. code-block:: php

   public function getPreferredLanguage(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setPreferredLanguage:

WorkDo::setPreferredLanguage
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================================================================== 
   predicates public                                                                     
   implements :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface::setPreferredLanguage` 
   ========== ========================================================================== 





.. code-block:: php

   public function setPreferredLanguage(
         Parameter #0 [ <required> ?string $preferred ]
    ): void


| :tag6:`param` ?\ string :param:`$preferred`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getMedia:

WorkDo::getMedia
----------------

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


.. _bhenk\gitzw\dao\WorkDo::setMedia:

WorkDo::setMedia
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setMedia(
         Parameter #0 [ <required> ?string $media ]
    ): void


| :tag6:`param` ?\ string :param:`$media`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getWidth:

WorkDo::getWidth
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::getWidth` 
   ========== ====================================================== 





.. code-block:: php

   public function getWidth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dao\WorkDo::setWidth:

WorkDo::setWidth
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::setWidth` 
   ========== ====================================================== 





.. code-block:: php

   public function setWidth(
         Parameter #0 [ <required> float $width ]
    ): void


| :tag6:`param` float :param:`$width`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getHeight:

WorkDo::getHeight
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================= 
   predicates public                                                  
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::getHeight` 
   ========== ======================================================= 





.. code-block:: php

   public function getHeight(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dao\WorkDo::setHeight:

WorkDo::setHeight
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================= 
   predicates public                                                  
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::setHeight` 
   ========== ======================================================= 





.. code-block:: php

   public function setHeight(
         Parameter #0 [ <required> float $height ]
    ): void


| :tag6:`param` float :param:`$height`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getDepth:

WorkDo::getDepth
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::getDepth` 
   ========== ====================================================== 





.. code-block:: php

   public function getDepth(): float


| :tag6:`return` float


----


.. _bhenk\gitzw\dao\WorkDo::setDepth:

WorkDo::setDepth
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::setDepth` 
   ========== ====================================================== 





.. code-block:: php

   public function setDepth(
         Parameter #0 [ <required> float $depth ]
    ): void


| :tag6:`param` float :param:`$depth`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getDimExtra:

WorkDo::getDimExtra
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================================================= 
   predicates public                                                    
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::getDimExtra` 
   ========== ========================================================= 





.. code-block:: php

   public function getDimExtra(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setDimExtra:

WorkDo::setDimExtra
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================================================= 
   predicates public                                                    
   implements :ref:`bhenk\gitzw\model\DimensionsInterface::setDimExtra` 
   ========== ========================================================= 





.. code-block:: php

   public function setDimExtra(
         Parameter #0 [ <required> ?string $dim_extra ]
    ): void


| :tag6:`param` ?\ string :param:`$dim_extra`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getDate:

WorkDo::getDate
---------------

.. table::
   :widths: auto
   :align: left

   ========== =============================================== 
   predicates public                                          
   implements :ref:`bhenk\gitzw\model\DateInterface::getDate` 
   ========== =============================================== 





.. code-block:: php

   public function getDate(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setDate:

WorkDo::setDate
---------------

.. table::
   :widths: auto
   :align: left

   ========== =============================================== 
   predicates public                                          
   implements :ref:`bhenk\gitzw\model\DateInterface::setDate` 
   ========== =============================================== 





.. code-block:: php

   public function setDate(
         Parameter #0 [ <required> string $date ]
    ): void


| :tag6:`param` string :param:`$date`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getDateFormat:

WorkDo::getDateFormat
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\DateInterface::getDateFormat` 
   ========== ===================================================== 





.. code-block:: php

   public function getDateFormat(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setDateFormat:

WorkDo::setDateFormat
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\DateInterface::setDateFormat` 
   ========== ===================================================== 





.. code-block:: php

   public function setDateFormat(
         Parameter #0 [ <required> ?string $d_format ]
    ): void


| :tag6:`param` ?\ string :param:`$d_format`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getHidden:

WorkDo::getHidden
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getHidden(): ?bool


| :tag6:`return` ?\ bool


----


.. _bhenk\gitzw\dao\WorkDo::setHidden:

WorkDo::setHidden
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setHidden(
         Parameter #0 [ <required> ?bool $hidden ]
    ): void


| :tag6:`param` ?\ bool :param:`$hidden`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getOrdinal:

WorkDo::getOrdinal
------------------

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


.. _bhenk\gitzw\dao\WorkDo::setOrdinal:

WorkDo::setOrdinal
------------------

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


.. _bhenk\gitzw\dao\WorkDo::getCategory:

WorkDo::getCategory
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCategory(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setCategory:

WorkDo::setCategory
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCategory(
         Parameter #0 [ <required> ?string $category ]
    ): void


| :tag6:`param` ?\ string :param:`$category`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getCreatorId:

WorkDo::getCreatorId
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCreatorId(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dao\WorkDo::setCreatorId:

WorkDo::setCreatorId
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCreatorId(
         Parameter #0 [ <required> ?int $creatorId ]
    ): void


| :tag6:`param` ?\ int :param:`$creatorId`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getTypes:

WorkDo::getTypes
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTypes(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setTypes:

WorkDo::setTypes
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTypes(
         Parameter #0 [ <required> ?string $types ]
    ): void


| :tag6:`param` ?\ string :param:`$types`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::getLocation:

WorkDo::getLocation
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getLocation(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\WorkDo::setLocation:

WorkDo::setLocation
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setLocation(
         Parameter #0 [ <required> ?string $location ]
    ): void


| :tag6:`param` ?\ string :param:`$location`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkDo::clone:

WorkDo::clone
-------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   implements     `EntityInterface::clone <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::clone <http://bhenkmsdata.rtfd.io/>`_          
   ============== ======================================================= 






.. admonition:: @inheritdoc

    

   **Create an Entity that equals this Entity**
   
   
   The newly created Entity gets the given ID or no ID if :tagsign:`param` :tech:`$ID` is *null*.
   
   | :tag6:`param` int | null :param:`$ID`
   | :tag6:`return` `Entity <http://bhenkmsdata.rtfd.io/>`_
   
   ``@inheritdoc`` from method `EntityInterface::clone <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function clone(
         Parameter #0 [ <optional> ?int $ID = NULL ]
    ): Entity


| :tag6:`param` ?\ int :param:`$ID`
| :tag6:`return` `Entity <http://bhenkmsdata.rtfd.io/>`_  - Entity, similar to this one, with the given ID
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dao\WorkDo::toArray:

WorkDo::toArray
---------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     public                                                    
   implements     `EntityInterface::toArray <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::toArray <http://bhenkmsdata.rtfd.io/>`_          
   ============== ========================================================= 






.. admonition:: @inheritdoc

    

   **Express the properties of this Entity in an array**
   
   
   The returned array should be in such order that it can be fet to the static method
   `EntityInterface::fromArray() <https://www.google.com/search?q=EntityInterface::fromArray()>`_.
   
   | :tag6:`return` array  - array with properties of this Entity
   
   ``@inheritdoc`` from method `EntityInterface::toArray <http://bhenkmsdata.rtfd.io/>`_





.. admonition::  see also

    `Entity::fromArray() <http://bhenkmsdata.rtfd.io/>`_


.. code-block:: php

   public function toArray(): array


| :tag6:`return` array  - array with properties


----


.. _bhenk\gitzw\dao\WorkDo::getParents:

WorkDo::getParents
------------------

.. table::
   :widths: auto
   :align: left

   ============== =================================================== 
   predicates     public                                              
   inherited from `Entity::getParents <http://bhenkmsdata.rtfd.io/>`_ 
   ============== =================================================== 


**Get the (Reflection) parents of this Entity in reverse order**



..  code-block::

   class A extends Entity
   
   class B extends A
   
   returned array = [Entity-Reflection, A-Reflection, B-Reflection]





.. code-block:: php

   public function getParents(): array


| :tag6:`return` array  - array with `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ parents and this Entity


----


.. _bhenk\gitzw\dao\WorkDo::fromArray:

WorkDo::fromArray
-----------------

.. table::
   :widths: auto
   :align: left

   ============== =========================================================== 
   predicates     public | static                                             
   implements     `EntityInterface::fromArray <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::fromArray <http://bhenkmsdata.rtfd.io/>`_          
   ============== =========================================================== 


**Create a new Entity**


The order of the given array should be *parent-first*, i.e.:

..  code-block::

   class A extends Entity
   
   class B extends A


In :tech:`__construct()`, :tech:`toArray()` and :tech:`fromArray()` functions,
properties/parameters have the order:

..  code-block::

   ID, {props of A}, {props of B}





.. admonition:: @inheritdoc

    

   **Create a new Entity from an array of properties**
   
   
   The given array should have the same order as the one gotten from `EntityInterface::toArray() <https://www.google.com/search?q=EntityInterface::toArray()>`_.
   
   
   | :tag6:`param` array :param:`$arr` - property array
   | :tag6:`return` `Entity <http://bhenkmsdata.rtfd.io/>`_  - newly created Entity with the given properties
   
   ``@inheritdoc`` from method `EntityInterface::fromArray <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public static function fromArray(
         Parameter #0 [ <required> array $arr ]
    ): static


| :tag6:`param` array :param:`$arr` - array with properties
| :tag6:`return` static  - Entity object
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dao\WorkDo::isSame:

WorkDo::isSame
--------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================== 
   predicates     public                                                   
   implements     `EntityInterface::isSame <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::isSame <http://bhenkmsdata.rtfd.io/>`_          
   ============== ======================================================== 






.. admonition:: @inheritdoc

    

   **Test is same function**
   
   
   The given Entity is similar to this Entity if all properties, including :tech:`ID`, are equal.
   
   | :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other` - Entity to test
   | :tag6:`return` bool  - *true* if all properties, including :tech:`ID`, are equal, *false* otherwise
   
   ``@inheritdoc`` from method `EntityInterface::isSame <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function isSame(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $other ]
    ): bool


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkDo::equals:

WorkDo::equals
--------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================== 
   predicates     public                                                   
   implements     `EntityInterface::equals <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::equals <http://bhenkmsdata.rtfd.io/>`_          
   ============== ======================================================== 






.. admonition:: @inheritdoc

    

   **Test equals function**
   
   
   The given Entity equals this Entity if all properties, except :tech:`ID`, are equal.
   
   | :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other` - Entity to test
   | :tag6:`return` bool  - *true* if all properties are equal, *false* otherwise
   
   ``@inheritdoc`` from method `EntityInterface::equals <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function equals(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $other ]
    ): bool


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkDo::getID:

WorkDo::getID
-------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   implements     `EntityInterface::getID <http://bhenkmsdata.rtfd.io/>`_ 
   inherited from `Entity::getID <http://bhenkmsdata.rtfd.io/>`_          
   ============== ======================================================= 






.. admonition:: @inheritdoc

    

   **Get the ID of this Entity or** *null* **if it has no ID**
   
   | :tag6:`return` int | null  - ID of this Entity or *null*
   
   ``@inheritdoc`` from method `EntityInterface::getID <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function getID(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dao\WorkDo::__toString:

WorkDo::__toString
------------------

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public                                                                              
   implements     `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   inherited from `Entity::__toString <http://bhenkmsdata.rtfd.io/>`_                                 
   ============== =================================================================================== 


**String representation of this Entity**


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string  - representing this Entity


----

:block:`no datestamp` 
