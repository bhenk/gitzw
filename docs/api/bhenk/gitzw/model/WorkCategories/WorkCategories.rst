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

.. _bhenk\gitzw\model\WorkCategories:

WorkCategories
==============

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================================================================== 
   namespace  bhenk\\gitzw\\model                                                                                                                 
   predicates Final | Enum                                                                                                                        
   implements `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ | `BackedEnum <https://www.php.net/manual/en/class.backedenum.php>`_ 
   ========== =================================================================================================================================== 


.. contents::


----


.. _bhenk\gitzw\model\WorkCategories::Constants:

Constants
+++++++++


.. _bhenk\gitzw\model\WorkCategories::draw:

WorkCategories::draw
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\gitzw\model\WorkCategories::draw) 




----


.. _bhenk\gitzw\model\WorkCategories::dry:

WorkCategories::dry
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\gitzw\model\WorkCategories::dry) 




----


.. _bhenk\gitzw\model\WorkCategories::paint:

WorkCategories::paint
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\gitzw\model\WorkCategories::paint) 




----


.. _bhenk\gitzw\model\WorkCategories::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\WorkCategories::forName:

WorkCategories::forName
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function forName(
         Parameter #0 [ <required> ?string $name ]
    ): ?WorkCategories


| :tag6:`param` ?\ string :param:`$name`
| :tag6:`return` ?\ :ref:`bhenk\gitzw\model\WorkCategories`


----


.. _bhenk\gitzw\model\WorkCategories::forValue:

WorkCategories::forValue
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function forValue(
         Parameter #0 [ <required> string $value ]
    ): ?WorkCategories


| :tag6:`param` string :param:`$value`
| :tag6:`return` ?\ :ref:`bhenk\gitzw\model\WorkCategories`


----


.. _bhenk\gitzw\model\WorkCategories::cases:

WorkCategories::cases
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ===================================================================== 
   predicates public | static                                                       
   implements `UnitEnum::cases <https://www.php.net/manual/en/unitenum.cases.php>`_ 
   ========== ===================================================================== 


.. code-block:: php

   public static function cases(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\model\WorkCategories::from:

WorkCategories::from
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ======================================================================= 
   predicates public | static                                                         
   implements `BackedEnum::from <https://www.php.net/manual/en/backedenum.from.php>`_ 
   ========== ======================================================================= 


.. code-block:: php

   public static function from(
         Parameter #0 [ <required> string|int $value ]
    ): static


| :tag6:`param` string | int :param:`$value`
| :tag6:`return` static


----


.. _bhenk\gitzw\model\WorkCategories::tryFrom:

WorkCategories::tryFrom
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ============================================================================= 
   predicates public | static                                                               
   implements `BackedEnum::tryFrom <https://www.php.net/manual/en/backedenum.tryfrom.php>`_ 
   ========== ============================================================================= 


.. code-block:: php

   public static function tryFrom(
         Parameter #0 [ <required> string|int $value ]
    ): ?static


| :tag6:`param` string | int :param:`$value`
| :tag6:`return` ?\ static


----

:block:`no datestamp` 
