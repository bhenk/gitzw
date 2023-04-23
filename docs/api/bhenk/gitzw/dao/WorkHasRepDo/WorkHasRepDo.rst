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

.. _bhenk\gitzw\dao\WorkHasRepDo:

WorkHasRepDo
============

.. table::
   :widths: auto
   :align: left

   ========== ======================================================================================================================= 
   namespace  bhenk\\gitzw\\dao                                                                                                       
   predicates Cloneable | Instantiable                                                                                                
   implements `EntityInterface <http://bhenkmsdata.rtfd.io/>`_ | `Stringable <https://www.php.net/manual/en/class.stringable.php>`_   
   extends    `Join <http://bhenkmsdata.rtfd.io/>`_                                                                                   
   hierarchy  :ref:`bhenk\gitzw\dao\WorkHasRepDo` -> `Join <http://bhenkmsdata.rtfd.io/>`_ -> `Entity <http://bhenkmsdata.rtfd.io/>`_ 
   ========== ======================================================================================================================= 


.. contents::


----


.. _bhenk\gitzw\dao\WorkHasRepDo::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dao\WorkHasRepDo::__construct:

WorkHasRepDo::__construct
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
         Parameter #1 [ <optional> ?int $FK_LEFT = NULL ]
         Parameter #2 [ <optional> ?int $FK_RIGHT = NULL ]
         Parameter #3 [ <optional> bool $deleted = false ]
         Parameter #4 [ <optional> ?string $description = NULL ]
         Parameter #5 [ <optional> bool $hidden = false ]
         Parameter #6 [ <optional> bool $preferred = false ]
         Parameter #7 [ <optional> int $ordinal = -1 ]
    )


| :tag5:`param` ?\ int :param:`$ID`
| :tag5:`param` ?\ int :param:`$FK_LEFT`
| :tag5:`param` ?\ int :param:`$FK_RIGHT`
| :tag5:`param` bool :param:`$deleted`
| :tag5:`param` ?\ string :param:`$description`
| :tag5:`param` bool :param:`$hidden`
| :tag5:`param` bool :param:`$preferred`
| :tag5:`param` int :param:`$ordinal`


----


.. _bhenk\gitzw\dao\WorkHasRepDo::Methods:

Methods
+++++++


.. _bhenk\gitzw\dao\WorkHasRepDo::getDescription:

WorkHasRepDo::getDescription
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


.. _bhenk\gitzw\dao\WorkHasRepDo::setDescription:

WorkHasRepDo::setDescription
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


.. _bhenk\gitzw\dao\WorkHasRepDo::isHidden:

WorkHasRepDo::isHidden
----------------------

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


.. _bhenk\gitzw\dao\WorkHasRepDo::setHidden:

WorkHasRepDo::setHidden
-----------------------

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


.. _bhenk\gitzw\dao\WorkHasRepDo::isPreferred:

WorkHasRepDo::isPreferred
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isPreferred(): bool


| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkHasRepDo::setPreferred:

WorkHasRepDo::setPreferred
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setPreferred(
         Parameter #0 [ <required> bool $preferred ]
    ): void


| :tag6:`param` bool :param:`$preferred`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkHasRepDo::getOrdinal:

WorkHasRepDo::getOrdinal
------------------------

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


.. _bhenk\gitzw\dao\WorkHasRepDo::setOrdinal:

WorkHasRepDo::setOrdinal
------------------------

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


.. _bhenk\gitzw\dao\WorkHasRepDo::getFkLeft:

WorkHasRepDo::getFkLeft
-----------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================ 
   predicates     public                                           
   inherited from `Join::getFkLeft <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================ 


**Get the left hand foreign key**


.. code-block:: php

   public function getFkLeft(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dao\WorkHasRepDo::setFkLeft:

WorkHasRepDo::setFkLeft
-----------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================ 
   predicates     public                                           
   inherited from `Join::setFkLeft <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================ 


**Set the left hand foreign key**


.. code-block:: php

   public function setFkLeft(
         Parameter #0 [ <required> ?int $FK_LEFT ]
    ): void


| :tag6:`param` ?\ int :param:`$FK_LEFT`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkHasRepDo::getFkRight:

WorkHasRepDo::getFkRight
------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================= 
   predicates     public                                            
   inherited from `Join::getFkRight <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================= 


**Get the right hand foreign key**


.. code-block:: php

   public function getFkRight(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\gitzw\dao\WorkHasRepDo::setFkRight:

WorkHasRepDo::setFkRight
------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================= 
   predicates     public                                            
   inherited from `Join::setFkRight <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================= 


**Set the right hand foreign key**


.. code-block:: php

   public function setFkRight(
         Parameter #0 [ <required> ?int $FK_RIGHT ]
    ): void


| :tag6:`param` ?\ int :param:`$FK_RIGHT`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkHasRepDo::isDeleted:

WorkHasRepDo::isDeleted
-----------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================ 
   predicates     public                                           
   inherited from `Join::isDeleted <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================ 


**Get whether this join-relation is deleted**


.. code-block:: php

   public function isDeleted(): bool


| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkHasRepDo::setDeleted:

WorkHasRepDo::setDeleted
------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================= 
   predicates     public                                            
   inherited from `Join::setDeleted <http://bhenkmsdata.rtfd.io/>`_ 
   ============== ================================================= 


**Sets whether this join-relation is deleted**


.. code-block:: php

   public function setDeleted(
         Parameter #0 [ <required> bool $deleted ]
    ): void


| :tag6:`param` bool :param:`$deleted`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\WorkHasRepDo::clone:

WorkHasRepDo::clone
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
   | :tag6:`return` `Entity <https://www.google.com/search?q=Entity>`_
   
   ``@inheritdoc`` from method `EntityInterface::clone <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function clone(
         Parameter #0 [ <optional> ?int $ID = NULL ]
    ): Entity


| :tag6:`param` ?\ int :param:`$ID`
| :tag6:`return` `Entity <http://bhenkmsdata.rtfd.io/>`_  - Entity, similar to this one, with the given ID
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dao\WorkHasRepDo::toArray:

WorkHasRepDo::toArray
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

    `Entity::fromArray() <https://www.google.com/search?q=Entity::fromArray()>`_


.. code-block:: php

   public function toArray(): array


| :tag6:`return` array  - array with properties


----


.. _bhenk\gitzw\dao\WorkHasRepDo::getParents:

WorkHasRepDo::getParents
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


.. _bhenk\gitzw\dao\WorkHasRepDo::fromArray:

WorkHasRepDo::fromArray
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
   | :tag6:`return` `Entity <https://www.google.com/search?q=Entity>`_  - newly created Entity with the given properties
   
   ``@inheritdoc`` from method `EntityInterface::fromArray <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public static function fromArray(
         Parameter #0 [ <required> array $arr ]
    ): static


| :tag6:`param` array :param:`$arr` - array with properties
| :tag6:`return` static  - Entity object
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dao\WorkHasRepDo::isSame:

WorkHasRepDo::isSame
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
   
   | :tag6:`param` `Entity <https://www.google.com/search?q=Entity>`_ :param:`$other` - Entity to test
   | :tag6:`return` bool  - *true* if all properties, including :tech:`ID`, are equal, *false* otherwise
   
   ``@inheritdoc`` from method `EntityInterface::isSame <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function isSame(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $other ]
    ): bool


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkHasRepDo::equals:

WorkHasRepDo::equals
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
   
   | :tag6:`param` `Entity <https://www.google.com/search?q=Entity>`_ :param:`$other` - Entity to test
   | :tag6:`return` bool  - *true* if all properties are equal, *false* otherwise
   
   ``@inheritdoc`` from method `EntityInterface::equals <http://bhenkmsdata.rtfd.io/>`_




.. code-block:: php

   public function equals(
         Parameter #0 [ <required> bhenk\msdata\abc\Entity $other ]
    ): bool


| :tag6:`param` `Entity <http://bhenkmsdata.rtfd.io/>`_ :param:`$other`
| :tag6:`return` bool


----


.. _bhenk\gitzw\dao\WorkHasRepDo::getID:

WorkHasRepDo::getID
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


.. _bhenk\gitzw\dao\WorkHasRepDo::__toString:

WorkHasRepDo::__toString
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
