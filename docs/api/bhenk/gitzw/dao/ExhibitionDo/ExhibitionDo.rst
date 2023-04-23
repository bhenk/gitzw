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

.. _bhenk\gitzw\dao\ExhibitionDo:

ExhibitionDo
============

.. table::
   :widths: auto
   :align: left

   ========== ===================================================================================================================================================================================================================== 
   namespace  bhenk\\gitzw\\dao                                                                                                                                                                                                     
   predicates Cloneable | Instantiable                                                                                                                                                                                              
   implements `EntityInterface <http://bhenkmsdata.rtfd.io/>`_ | `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | :ref:`bhenk\gitzw\model\DateInterface` | :ref:`bhenk\gitzw\model\MultiLanguageTitleInterface` 
   extends    `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                                                                                                               
   hierarchy  :ref:`bhenk\gitzw\dao\ExhibitionDo` -> `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                                                                        
   ========== ===================================================================================================================================================================================================================== 


.. contents::


----


.. _bhenk\gitzw\dao\ExhibitionDo::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dao\ExhibitionDo::__construct:

ExhibitionDo::__construct
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?int $ID = NULL ]
         Parameter #1 [ <optional> ?string $EXHID = NULL ]
         Parameter #2 [ <optional> ?string $title_en = NULL ]
         Parameter #3 [ <optional> ?string $title_nl = NULL ]
         Parameter #4 [ <optional> ?string $preferred = NULL ]
         Parameter #5 [ <optional> ?string $subtitle = NULL ]
         Parameter #6 [ <optional> ?string $date = NULL ]
         Parameter #7 [ <optional> ?string $d_format = NULL ]
         Parameter #8 [ <optional> ?string $description = NULL ]
    )


| :tag5:`param` ?\ int :param:`$ID`
| :tag5:`param` ?\ string :param:`$EXHID`
| :tag5:`param` ?\ string :param:`$title_en`
| :tag5:`param` ?\ string :param:`$title_nl`
| :tag5:`param` ?\ string :param:`$preferred`
| :tag5:`param` ?\ string :param:`$subtitle`
| :tag5:`param` ?\ string :param:`$date`
| :tag5:`param` ?\ string :param:`$d_format`
| :tag5:`param` ?\ string :param:`$description`


----


.. _bhenk\gitzw\dao\ExhibitionDo::Methods:

Methods
+++++++


.. _bhenk\gitzw\dao\ExhibitionDo::getEXHID:

ExhibitionDo::getEXHID
----------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setEXHID:

ExhibitionDo::setEXHID
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setEXHID(
         Parameter #0 [ <required> ?string $EXHID ]
    ): void


| :tag6:`param` ?\ string :param:`$EXHID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\ExhibitionDo::getDescription:

ExhibitionDo::getDescription
----------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setDescription:

ExhibitionDo::setDescription
----------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getDate:

ExhibitionDo::getDate
---------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setDate:

ExhibitionDo::setDate
---------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getDateFormat:

ExhibitionDo::getDateFormat
---------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setDateFormat:

ExhibitionDo::setDateFormat
---------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getTitleEn:

ExhibitionDo::getTitleEn
------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setTitleEn:

ExhibitionDo::setTitleEn
------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getTitleNl:

ExhibitionDo::getTitleNl
------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setTitleNl:

ExhibitionDo::setTitleNl
------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getPreferredLanguage:

ExhibitionDo::getPreferredLanguage
----------------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setPreferredLanguage:

ExhibitionDo::setPreferredLanguage
----------------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getSubtitle:

ExhibitionDo::getSubtitle
-------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::setSubtitle:

ExhibitionDo::setSubtitle
-------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::clone:

ExhibitionDo::clone
-------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::toArray:

ExhibitionDo::toArray
---------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getParents:

ExhibitionDo::getParents
------------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::fromArray:

ExhibitionDo::fromArray
-----------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::isSame:

ExhibitionDo::isSame
--------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::equals:

ExhibitionDo::equals
--------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::getID:

ExhibitionDo::getID
-------------------

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


.. _bhenk\gitzw\dao\ExhibitionDo::__toString:

ExhibitionDo::__toString
------------------------

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
