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

.. _bhenk\gitzw\dao\CreatorDo:

CreatorDo
=========

.. table::
   :widths: auto
   :align: left

   ========== ================================================================================================================================================================ 
   namespace  bhenk\\gitzw\\dao                                                                                                                                                
   predicates Cloneable | Instantiable                                                                                                                                         
   implements `EntityInterface <http://bhenkmsdata.rtfd.io/>`_ | `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | :ref:`bhenk\gitzw\model\PersonInterface` 
   extends    `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                                                          
   hierarchy  :ref:`bhenk\gitzw\dao\CreatorDo` -> `Entity <http://bhenkmsdata.rtfd.io/>`_                                                                                      
   ========== ================================================================================================================================================================ 


.. contents::


----


.. _bhenk\gitzw\dao\CreatorDo::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dao\CreatorDo::__construct:

CreatorDo::__construct
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?int $ID = NULL ]
         Parameter #1 [ <optional> ?string $CRID = NULL ]
         Parameter #2 [ <optional> ?string $firstname = NULL ]
         Parameter #3 [ <optional> ?string $prefixes = NULL ]
         Parameter #4 [ <optional> ?string $lastname = NULL ]
         Parameter #5 [ <optional> ?string $description = NULL ]
         Parameter #6 [ <optional> ?string $url = NULL ]
         Parameter #7 [ <optional> ?string $sameAs = NULL ]
    )


| :tag5:`param` ?\ int :param:`$ID`
| :tag5:`param` ?\ string :param:`$CRID`
| :tag5:`param` ?\ string :param:`$firstname`
| :tag5:`param` ?\ string :param:`$prefixes`
| :tag5:`param` ?\ string :param:`$lastname`
| :tag5:`param` ?\ string :param:`$description`
| :tag5:`param` ?\ string :param:`$url`
| :tag5:`param` ?\ string :param:`$sameAs`


----


.. _bhenk\gitzw\dao\CreatorDo::Methods:

Methods
+++++++


.. _bhenk\gitzw\dao\CreatorDo::getCRID:

CreatorDo::getCRID
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================= 
   predicates public                                            
   implements :ref:`bhenk\gitzw\model\PersonInterface::getCRID` 
   ========== ================================================= 





.. code-block:: php

   public function getCRID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setCRID:

CreatorDo::setCRID
------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================= 
   predicates public                                            
   implements :ref:`bhenk\gitzw\model\PersonInterface::setCRID` 
   ========== ================================================= 





.. code-block:: php

   public function setCRID(
         Parameter #0 [ <required> ?string $CRID ]
    ): void


| :tag6:`param` ?\ string :param:`$CRID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getFirstname:

CreatorDo::getFirstname
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\PersonInterface::getFirstname` 
   ========== ====================================================== 





.. code-block:: php

   public function getFirstname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setFirstname:

CreatorDo::setFirstname
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\model\PersonInterface::setFirstname` 
   ========== ====================================================== 





.. code-block:: php

   public function setFirstname(
         Parameter #0 [ <required> ?string $firstname ]
    ): void


| :tag6:`param` ?\ string :param:`$firstname`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getPrefixes:

CreatorDo::getPrefixes
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\PersonInterface::getPrefixes` 
   ========== ===================================================== 





.. code-block:: php

   public function getPrefixes(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setPrefixes:

CreatorDo::setPrefixes
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\PersonInterface::setPrefixes` 
   ========== ===================================================== 





.. code-block:: php

   public function setPrefixes(
         Parameter #0 [ <required> ?string $prefixes ]
    ): void


| :tag6:`param` ?\ string :param:`$prefixes`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getLastname:

CreatorDo::getLastname
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\PersonInterface::getLastname` 
   ========== ===================================================== 





.. code-block:: php

   public function getLastname(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setLastname:

CreatorDo::setLastname
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================== 
   predicates public                                                
   implements :ref:`bhenk\gitzw\model\PersonInterface::setLastname` 
   ========== ===================================================== 





.. code-block:: php

   public function setLastname(
         Parameter #0 [ <required> ?string $lastname ]
    ): void


| :tag6:`param` ?\ string :param:`$lastname`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getDescription:

CreatorDo::getDescription
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================== 
   predicates public                                                   
   implements :ref:`bhenk\gitzw\model\PersonInterface::getDescription` 
   ========== ======================================================== 





.. code-block:: php

   public function getDescription(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setDescription:

CreatorDo::setDescription
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================== 
   predicates public                                                   
   implements :ref:`bhenk\gitzw\model\PersonInterface::setDescription` 
   ========== ======================================================== 





.. code-block:: php

   public function setDescription(
         Parameter #0 [ <required> ?string $description ]
    ): void


| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getUrl:

CreatorDo::getUrl
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================ 
   predicates public                                           
   implements :ref:`bhenk\gitzw\model\PersonInterface::getUrl` 
   ========== ================================================ 





.. code-block:: php

   public function getUrl(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setUrl:

CreatorDo::setUrl
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================ 
   predicates public                                           
   implements :ref:`bhenk\gitzw\model\PersonInterface::setUrl` 
   ========== ================================================ 





.. code-block:: php

   public function setUrl(
         Parameter #0 [ <required> ?string $url ]
    ): void


| :tag6:`param` ?\ string :param:`$url`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::getSameAs:

CreatorDo::getSameAs
--------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================== 
   predicates public                                              
   implements :ref:`bhenk\gitzw\model\PersonInterface::getSameAs` 
   ========== =================================================== 





.. code-block:: php

   public function getSameAs(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dao\CreatorDo::setSameAs:

CreatorDo::setSameAs
--------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================== 
   predicates public                                              
   implements :ref:`bhenk\gitzw\model\PersonInterface::setSameAs` 
   ========== =================================================== 





.. code-block:: php

   public function setSameAs(
         Parameter #0 [ <required> ?string $sameAs ]
    ): void


| :tag6:`param` ?\ string :param:`$sameAs`
| :tag6:`return` void


----


.. _bhenk\gitzw\dao\CreatorDo::clone:

CreatorDo::clone
----------------

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


.. _bhenk\gitzw\dao\CreatorDo::toArray:

CreatorDo::toArray
------------------

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


.. _bhenk\gitzw\dao\CreatorDo::getParents:

CreatorDo::getParents
---------------------

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


.. _bhenk\gitzw\dao\CreatorDo::fromArray:

CreatorDo::fromArray
--------------------

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


.. _bhenk\gitzw\dao\CreatorDo::isSame:

CreatorDo::isSame
-----------------

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


.. _bhenk\gitzw\dao\CreatorDo::equals:

CreatorDo::equals
-----------------

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


.. _bhenk\gitzw\dao\CreatorDo::getID:

CreatorDo::getID
----------------

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


.. _bhenk\gitzw\dao\CreatorDo::__toString:

CreatorDo::__toString
---------------------

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
