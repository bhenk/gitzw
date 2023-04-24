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

.. _bhenk\gitzw\model\DateTrait:

DateTrait
=========

.. table::
   :widths: auto
   :align: left

   ========== =================== 
   namespace  bhenk\\gitzw\\model 
   predicates Trait               
   ========== =================== 


.. contents::


----


.. _bhenk\gitzw\model\DateTrait::Methods:

Methods
+++++++


.. _bhenk\gitzw\model\DateTrait::initDateTrait:

DateTrait::initDateTrait
------------------------

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


.. _bhenk\gitzw\model\DateTrait::getDate:

DateTrait::getDate
------------------

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


.. _bhenk\gitzw\model\DateTrait::setDate:

DateTrait::setDate
------------------

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


.. _bhenk\gitzw\model\DateTrait::rearrangeDate:

DateTrait::rearrangeDate
------------------------

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
