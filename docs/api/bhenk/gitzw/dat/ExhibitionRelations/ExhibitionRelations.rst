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

.. _bhenk\gitzw\dat\ExhibitionRelations:

ExhibitionRelations
===================

.. table::
   :widths: auto
   :align: left

   ========== ======================================================================================== 
   namespace  bhenk\\gitzw\\dat                                                                        
   predicates Cloneable | Instantiable                                                                 
   extends    :ref:`bhenk\gitzw\dat\RepresentationOwner`                                               
   hierarchy  :ref:`bhenk\gitzw\dat\ExhibitionRelations` -> :ref:`bhenk\gitzw\dat\RepresentationOwner` 
   ========== ======================================================================================== 


**The ExhibitionRelations object keeps track of the relations the owner Exhibition has to other objects**


.. contents::


----


.. _bhenk\gitzw\dat\ExhibitionRelations::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\ExhibitionRelations::__construct:

ExhibitionRelations::__construct
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


**Construct a ExhibitionRelations object**


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?int $exhibitionID = NULL ]
         Parameter #1 [ <optional> ?array $repRelations = NULL ]
    )


| :tag5:`param` ?\ int :param:`$exhibitionID` - ID of the owner Exhibition
| :tag5:`param` ?\ array :param:`$repRelations`


----


.. _bhenk\gitzw\dat\ExhibitionRelations::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\ExhibitionRelations::getOwnerId:

ExhibitionRelations::getOwnerId
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\dat\RepresentationOwner::getOwnerID` 
   ========== ====================================================== 


**Get the ID of the Exhibition that owns these relations**


.. code-block:: php

   public function getOwnerId(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\ExhibitionRelations::addRepresentation:

ExhibitionRelations::addRepresentation
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Add a Representation to this Exhibition**


Only Representations that are persisted and that are related to at least one Work can be added.




.. admonition::  see also

    :ref:`bhenk\gitzw\dat\ExhibitionRelations::getLastMessage`


.. code-block:: php

   public function addRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): ExhHasRepDo|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation` - Representation ID (int), Representation REPID (string) or Representation (object)
| :tag6:`return` :ref:`bhenk\gitzw\dao\ExhHasRepDo` | bool  - relation Data Object if successful, *false* otherwise
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::removeRepresentation:

ExhibitionRelations::removeRepresentation
-----------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements :ref:`bhenk\gitzw\dat\RepresentationOwner::removeRepresentation` 
   ========== ================================================================ 





.. code-block:: php

   public function removeRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getRepRelations:

ExhibitionRelations::getRepRelations
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =========================================================== 
   predicates public                                                      
   implements :ref:`bhenk\gitzw\dat\RepresentationOwner::getRepRelations` 
   ========== =========================================================== 


**Lazily fetch the join objects aka ExhHasRepDo's**


.. code-block:: php

   public function getRepRelations(): array


| :tag6:`return` array  - array with Representation ID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::persist:

ExhibitionRelations::persist
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 



.. danger:: 

    **@internal** 


**Persist relations kept by this Relations Object**


.. code-block:: php

   public function persist(
         Parameter #0 [ <required> int $exhibitionID ]
    ): bool


| :tag6:`param` int :param:`$exhibitionID` - ID of the owner object
| :tag6:`return` bool  - *true* if relations were present, *false* otherwise
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getRelation:

ExhibitionRelations::getRelation
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the relation data object that relates the Work with the given ID**


.. code-block:: php

   public function getRelation(
         Parameter #0 [ <required> int $workID ]
    ): ?ExhHasRepDo


| :tag6:`param` int :param:`$workID` - ID of the work
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dao\ExhHasRepDo`  - relation data object or *null* if relation not present
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::deserialize:

ExhibitionRelations::deserialize
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 



.. danger:: 

    **@internal** 


**Function called by ExhibitionStore**


.. code-block:: php

   public function deserialize(): int


| :tag6:`return` int  - count of persisted relations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getRepresentations:

ExhibitionRelations::getRepresentations
---------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ============================================================== 
   predicates     public                                                         
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::getRepresentations` 
   ============== ============================================================== 


**Lazily fetch the related Representations**


.. code-block:: php

   public function getRepresentations(): array


| :tag6:`return` array  - owned Representations, array with Representation ID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getRepresentation:

ExhibitionRelations::getRepresentation
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ============================================================= 
   predicates     public                                                        
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::getRepresentation` 
   ============== ============================================================= 


**Get the Representation with the given Representation ID**


.. code-block:: php

   public function getRepresentation(
         Parameter #0 [ <required> int $representationID ]
    ): ?Representation


| :tag6:`param` int :param:`$representationID` - ID of the Representation
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dat\Representation`  - Representation or *null* if Representation not related
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::doAddRepr:

ExhibitionRelations::doAddRepr
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ===================================================== 
   predicates     protected                                             
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::doAddRepr` 
   ============== ===================================================== 


**Actually add the Representation without checks**


.. code-block:: php

   protected function doAddRepr(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $repr ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$repr`
| :tag6:`return` void
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::doRemoveRepr:

ExhibitionRelations::doRemoveRepr
---------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================== 
   predicates     protected                                                
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::doRemoveRepr` 
   ============== ======================================================== 


**Actually remove the Representation without checks**


.. code-block:: php

   protected function doRemoveRepr(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation $repr ]
    ): void


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` :param:`$repr`
| :tag6:`return` void
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getLastMessage:

ExhibitionRelations::getLastMessage
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================== 
   predicates     public                                                     
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::getLastMessage` 
   ============== ========================================================== 


**Get the last message or false if no message**


.. code-block:: php

   public function getLastMessage(): string|bool


| :tag6:`return` string | bool


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getMessages:

ExhibitionRelations::getMessages
--------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::getMessages` 
   ============== ======================================================= 





.. code-block:: php

   public function getMessages(): array


| :tag6:`return` array


----


.. _bhenk\gitzw\dat\ExhibitionRelations::getMessagesAsString:

ExhibitionRelations::getMessagesAsString
----------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== =============================================================== 
   predicates     public                                                          
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::getMessagesAsString` 
   ============== =============================================================== 


.. code-block:: php

   public function getMessagesAsString(): string


| :tag6:`return` string


----


.. _bhenk\gitzw\dat\ExhibitionRelations::addMessage:

ExhibitionRelations::addMessage
-------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ====================================================== 
   predicates     protected                                              
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::addMessage` 
   ============== ====================================================== 





.. code-block:: php

   protected function addMessage(
         Parameter #0 [ <required> string $message ]
    ): void


| :tag6:`param` string :param:`$message`
| :tag6:`return` void


----


.. _bhenk\gitzw\dat\ExhibitionRelations::resetMessages:

ExhibitionRelations::resetMessages
----------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================= 
   predicates     protected                                                 
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::resetMessages` 
   ============== ========================================================= 


.. code-block:: php

   protected function resetMessages(): void


| :tag6:`return` void


----


.. _bhenk\gitzw\dat\ExhibitionRelations::exhibitionCanAddRepresentation:

ExhibitionRelations::exhibitionCanAddRepresentation
---------------------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================================================== 
   predicates     protected                                                                  
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::exhibitionCanAddRepresentation` 
   ============== ========================================================================== 





.. code-block:: php

   protected function exhibitionCanAddRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::workCanAddRepresentation:

ExhibitionRelations::workCanAddRepresentation
---------------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================================== 
   predicates     protected                                                            
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::workCanAddRepresentation` 
   ============== ==================================================================== 





.. code-block:: php

   protected function workCanAddRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::exhibitionCanRemoveRepresentation:

ExhibitionRelations::exhibitionCanRemoveRepresentation
------------------------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ============================================================================= 
   predicates     protected                                                                     
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::exhibitionCanRemoveRepresentation` 
   ============== ============================================================================= 





.. code-block:: php

   protected function exhibitionCanRemoveRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\ExhibitionRelations::workCanRemoveRepresentation:

ExhibitionRelations::workCanRemoveRepresentation
------------------------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================================= 
   predicates     protected                                                               
   inherited from :ref:`bhenk\gitzw\dat\RepresentationOwner::workCanRemoveRepresentation` 
   ============== ======================================================================= 





.. code-block:: php

   protected function workCanRemoveRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): Representation|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation`
| :tag6:`return` :ref:`bhenk\gitzw\dat\Representation` | bool
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----

:block:`no datestamp` 
