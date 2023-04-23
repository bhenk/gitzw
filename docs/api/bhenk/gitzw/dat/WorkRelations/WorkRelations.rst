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

.. _bhenk\gitzw\dat\WorkRelations:

WorkRelations
=============

.. table::
   :widths: auto
   :align: left

   ========== ================================================================================== 
   namespace  bhenk\\gitzw\\dat                                                                  
   predicates Cloneable | Instantiable                                                           
   extends    :ref:`bhenk\gitzw\dat\RepresentationOwner`                                         
   hierarchy  :ref:`bhenk\gitzw\dat\WorkRelations` -> :ref:`bhenk\gitzw\dat\RepresentationOwner` 
   ========== ================================================================================== 


**The WorkRelations object keeps track of relations the owner** :ref:`bhenk\gitzw\dat\Work` **has to other objects**


.. contents::


----


.. _bhenk\gitzw\dat\WorkRelations::Constructor:

Constructor
+++++++++++


.. _bhenk\gitzw\dat\WorkRelations::__construct:

WorkRelations::__construct
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


**Construct a WorkRelations object**


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?int $workID = NULL ]
         Parameter #1 [ <optional> ?array $repRelations = NULL ]
    )


| :tag5:`param` ?\ int :param:`$workID` - ID of the owner object or *null* if it does not have an ID (yet)
| :tag5:`param` ?\ array :param:`$repRelations`


----


.. _bhenk\gitzw\dat\WorkRelations::Methods:

Methods
+++++++


.. _bhenk\gitzw\dat\WorkRelations::getOwnerID:

WorkRelations::getOwnerID
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====================================================== 
   predicates public                                                 
   implements :ref:`bhenk\gitzw\dat\RepresentationOwner::getOwnerID` 
   ========== ====================================================== 


.. code-block:: php

   public function getOwnerID(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\gitzw\dat\WorkRelations::addRepresentation:

WorkRelations::addRepresentation
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Add a** :ref:`bhenk\gitzw\dat\Representation`


The :tagsign:`param` :tech:`$representation` can be the Representation ID (int), the Representation REPID (string)
or the Representation (Object) itself. Only Representations that are persisted can be added.




.. code-block:: php

   public function addRepresentation(
         Parameter #0 [ <required> bhenk\gitzw\dat\Representation|string|int $representation ]
    ): WorkHasRepDo|bool


| :tag6:`param` :ref:`bhenk\gitzw\dat\Representation` | string | int :param:`$representation` - Representation ID (int), Representation REPID (string) or Representation (object)
| :tag6:`return` :ref:`bhenk\gitzw\dao\WorkHasRepDo` | bool  - relation data object if representation successfully added, *false* otherwise
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkRelations::removeRepresentation:

WorkRelations::removeRepresentation
-----------------------------------

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


----


.. _bhenk\gitzw\dat\WorkRelations::getRepRelations:

WorkRelations::getRepRelations
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =========================================================== 
   predicates public                                                      
   implements :ref:`bhenk\gitzw\dat\RepresentationOwner::getRepRelations` 
   ========== =========================================================== 


**Lazily fetch the join objects aka repRelations**


.. code-block:: php

   public function getRepRelations(): array


| :tag6:`return` array  - array with Representation ID as key
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkRelations::persist:

WorkRelations::persist
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 



.. danger:: 

    **@internal** 


**Persist relations kept by this Relations Object**


This action ingests, updates and deletes relations. After a call to this method all relations
kept by this WorkRelations object are in sync with the persistence store.



.. code-block:: php

   public function persist(
         Parameter #0 [ <required> int $workId ]
    ): bool


| :tag6:`param` int :param:`$workId` - ID of the owner object
| :tag6:`return` bool  - *true* if relations were present, *false* otherwise
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkRelations::getRelation:

WorkRelations::getRelation
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the relation data object that relates the Representation with the given ID**


.. code-block:: php

   public function getRelation(
         Parameter #0 [ <required> int $representationId ]
    ): ?WorkHasRepDo


| :tag6:`param` int :param:`$representationId` - ID of the Representation
| :tag6:`return` ?\ :ref:`bhenk\gitzw\dao\WorkHasRepDo`  - relation data object or *null* if relation not present
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkRelations::deserialize:

WorkRelations::deserialize
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 



.. danger:: 

    **@internal** Not public API


**Function called by WorkStore**


.. code-block:: php

   public function deserialize(): int


| :tag6:`return` int  - count of persisted relations
| :tag6:`throws` `Exception <https://www.php.net/manual/en/class.exception.php>`_


----


.. _bhenk\gitzw\dat\WorkRelations::getRepresentations:

WorkRelations::getRepresentations
---------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::getRepresentation:

WorkRelations::getRepresentation
--------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::doAddRepr:

WorkRelations::doAddRepr
------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::doRemoveRepr:

WorkRelations::doRemoveRepr
---------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::getLastMessage:

WorkRelations::getLastMessage
-----------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::getMessages:

WorkRelations::getMessages
--------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::getMessagesAsString:

WorkRelations::getMessagesAsString
----------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::addMessage:

WorkRelations::addMessage
-------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::resetMessages:

WorkRelations::resetMessages
----------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::exhibitionCanAddRepresentation:

WorkRelations::exhibitionCanAddRepresentation
---------------------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::workCanAddRepresentation:

WorkRelations::workCanAddRepresentation
---------------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::exhibitionCanRemoveRepresentation:

WorkRelations::exhibitionCanRemoveRepresentation
------------------------------------------------

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


.. _bhenk\gitzw\dat\WorkRelations::workCanRemoveRepresentation:

WorkRelations::workCanRemoveRepresentation
------------------------------------------

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
