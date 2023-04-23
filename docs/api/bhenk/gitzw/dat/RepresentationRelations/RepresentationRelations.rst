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

.. _bhenk\gitzw\dat\RepresentationRelations:

RepresentationRelations
=======================

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\gitzw\\dat        
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Keeps track of work and exhibition relations for the owner Representation**


.. contents::


----


.. _bhenk\gitzw\dat\RepresentationRelations::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\RepresentationRelations::__construct:

RepresentationRelations::__construct
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> ?int $representationId ]
    )


| :tag5:`param` ?\ int :param:`$representationId`


----


.. _bhenk\gitzw\dat\RepresentationRelations::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\RepresentationRelations::resetRelations:

RepresentationRelations::resetRelations
---------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Reset relations**


Forces this object to nullify works, work relations, exhibitions and exhibition relations,
effectively forcing it to fetch said collections anew from database when requested.



.. code-block:: php

   public function resetRelations(): void


| :tag6:`return` void


----


.. _bhenk\gitzw\dat\RepresentationRelations::getWorkRelation:

RepresentationRelations::getWorkRelation
----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the work relation for the given Work ID**


.. code-block:: php

   public function getWorkRelation(
         Parameter #0 [ <required> int $workId ]
    ): ?WorkHasRepDo


| :tag6:`param` int :param:`$workId` - ID of Work
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dao\WorkHasRepDo`  - work relation or *null* if no such relation exists
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getWorkRelations:

RepresentationRelations::getWorkRelations
-----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get all work relations of the owner Representation**


.. code-block:: php

   public function getWorkRelations(): array


| :tag6:`return` array  - array<workID, WorkHasRepDo> with workID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getExhibitionRelation:

RepresentationRelations::getExhibitionRelation
----------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the exhibition relation for the given Exhibition ID**


.. code-block:: php

   public function getExhibitionRelation(
         Parameter #0 [ <required> int $exhibitionID ]
    ): ?ExhHasRepDo


| :tag6:`param` int :param:`$exhibitionID` - ID of Exhibition
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dao\ExhHasRepDo`  - exhibition relation or *null* if no such relation exists
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getExhibitionRelations:

RepresentationRelations::getExhibitionRelations
-----------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get all exhibition relations of the owner Representation**


.. code-block:: php

   public function getExhibitionRelations(): array


| :tag6:`return` array  - array<exhibitionID, ExhHasRepDo> with exhibitionID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getWork:

RepresentationRelations::getWork
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the Work with the given ID related to this Representation**


.. code-block:: php

   public function getWork(
         Parameter #0 [ <required> int $workId ]
    ): ?Work


| :tag6:`param` int :param:`$workId` - ID of Work
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dat\Work`  - Work or *null* if no relation exists
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getWorks:

RepresentationRelations::getWorks
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get all Works related to this Representation**


.. code-block:: php

   public function getWorks(): array


| :tag6:`return` array  - array<workId, Work> with workId as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getExhibition:

RepresentationRelations::getExhibition
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the Exhibition with the given ID related to this Representation**


.. code-block:: php

   public function getExhibition(
         Parameter #0 [ <required> int $exhibitionID ]
    ): ?Exhibition


| :tag6:`param` int :param:`$exhibitionID` - ID of Exhibition
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dat\Exhibition`  - Exhibition or *null* if no relation exists
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\RepresentationRelations::getExhibitions:

RepresentationRelations::getExhibitions
---------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get all Exhibitions related to this Representation**


.. code-block:: php

   public function getExhibitions(): array


| :tag6:`return` array  - array<exhibitionId, Exhibition> with exhibitionId as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
