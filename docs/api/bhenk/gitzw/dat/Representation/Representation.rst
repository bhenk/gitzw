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

.. _bhenk\gitzw\dat\Representation:

Representation
==============

.. table::
   :widths: auto
   :align: left

   ========== ============================================================================================ 
   namespace  bhenk\\gitzw\\dat                                                                            
   predicates Cloneable | Instantiable                                                                     
   implements :ref:`bhenk\gitzw\model\StoredObjectInterface` | :ref:`bhenk\gitzw\model\JsonAwareInterface` 
   uses       :ref:`bhenk\gitzw\model\DateTrait`                                                           
   ========== ============================================================================================ 


**A Representation represents a manifestation of a Work**


.. contents::


----


.. _bhenk\gitzw\dat\Representation::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\Representation::__construct:

Representation::__construct
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> bhenk\gitzw\dao\RepresentationDo $repDo = new \bhenk\gitzw\dao\RepresentationDo() ]
    )


| :tag5:`param` :ref:`bhenk\gitzw\dao\RepresentationDo` :param:`$repDo`


----


.. _bhenk\gitzw\dat\Representation::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\Representation::getID:

Representation::getID
---------------------

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


.. _bhenk\gitzw\dat\Representation::serialize:

Representation::serialize
-------------------------

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


.. _bhenk\gitzw\dat\Representation::deserialize:

Representation::deserialize
---------------------------

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
    ): Representation


| :tag6:`param` string :param:`$serialized`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation`
| :tag6:`throws` `ReflectionException <https://www.php.net/manual/en/class.reflectionexception.php>`_


----


.. _bhenk\gitzw\dat\Representation::getREPID:

Representation::getREPID
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getREPID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Representation::setREPID:

Representation::setREPID
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setREPID(
         Parameter #0 [ <required> string $REPID ]
    ): void


| :tag6:`param` string :param:`$REPID`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Representation::getSource:

Representation::getSource
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getSource(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\Representation::setSource:

Representation::setSource
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setSource(
         Parameter #0 [ <required> string $source ]
    ): void


| :tag6:`param` string :param:`$source`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Representation::getDescription:

Representation::getDescription
------------------------------

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


.. _bhenk\gitzw\dat\Representation::setDescription:

Representation::setDescription
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setDescription(
         Parameter #0 [ <required> string $description ]
    ): void


| :tag6:`param` string :param:`$description`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\Representation::getRepresentationDo:

Representation::getRepresentationDo
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getRepresentationDo(): RepresentationDo


| :tag6:`return` :ref:`bhenk\gitzw\dao\RepresentationDo`


----


.. _bhenk\gitzw\dat\Representation::getRelations:

Representation::getRelations
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getRelations(): RepresentationRelations


| :tag6:`return` :ref:`bhenk\gitzw\dat\RepresentationRelations`


----


.. _bhenk\gitzw\dat\Representation::initDateTrait:

Representation::initDateTrait
-----------------------------

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


.. _bhenk\gitzw\dat\Representation::getDate:

Representation::getDate
-----------------------

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


.. _bhenk\gitzw\dat\Representation::setDate:

Representation::setDate
-----------------------

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


.. _bhenk\gitzw\dat\Representation::rearrangeDate:

Representation::rearrangeDate
-----------------------------

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
