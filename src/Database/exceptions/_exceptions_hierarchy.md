
## Exceptions hierarchy:

- DatabaseException - Database error
    - ServiceUnavailableException - Server is temporarily unavailable. Connection refused or aborted
    - ConnectionErrorException - Connection failure
    - AccessDeniedException - Insufficient user privileges
    - QueryException - Exception caused by user mistake
        - SyntaxErrorException - Statement syntax error caused by user
            - InvalidValueException - Invalid value given by user or returned by query
            - CollationException - Text collation error or mismatch
        - LogicErrorException - Statement logic error. You are doing something wrong
            - NotSupportedException - Operation is not supported in this context, configuration or version
            - NameConflictException - Entity (table, column, index...) already exists
        - IntegrityConstraintException - Integrity constraint error
            - DuplicateEntryException - Duplicate entry (integrity constraint error)
        - NotFoundException - Entity (table, column, index...) was not found
        - DebugException - Debugging and unhandled user errors
    - ConcurrencyException - Concurrency issues
        - LockException - Cannot perform operation due to locks
            - DeadlockException - Deadlock. Cannot be prevented. Run transaction again
        - AbortedException - Operation was aborted by admin
    - FailureException - Exception caused by admin, configuration, runtime or system failure
        - ConfigException - Wrong or unreadable configuration file
        - ResourcesException - Resource or configuration limit reached
            - InsufficientResourcesException - System resources (RAM, disk, threads...) temporarily depleeted
            - LimitsExceededException - Configured or native database limits exceeded
        - RuntimeException - Miscellaneous runtime exceptions (probably not caused by user)
            - StorageException - Database storage errors caused by the underlying filesystem
        - CorruptedException - Corrupted or obsolete database structures
    - BinlogException - Binary logging error
    - ReplicationException - Master/slave replication error
    - EventException - Events or event scheduler error
    - ExtensionException - User extensions or UDF error
    - RemoteStorageException - Remote server or FEDERATED engine error
    - PartitioningException - Table partitioning error
    - FilesException - Tablespace and file groups error
    - XaException - Distributed 'XA' transaction error
