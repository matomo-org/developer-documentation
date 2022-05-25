<small>Piwik\Plugins\Diagnostics\Diagnostic\</small>

Diagnostic
==========

Performs a diagnostic on the system or Piwik.

Example:

    class MyDiagnostic implements Diagnostic
    {
        public function execute()
        {
            $results = array();

            // First check (error)
            $status = testSomethingIsOk() ? DiagnosticResult::STATUS_OK : DiagnosticResult::STATUS_ERROR;
            $results[] = DiagnosticResult::singleResult('First check', $status);

            // Second check (warning)
            $status = testSomethingElseIsOk() ? DiagnosticResult::STATUS_OK : DiagnosticResult::STATUS_WARNING;
            $results[] = DiagnosticResult::singleResult('Second check', $status);

            return $results;
        }
    }

Diagnostics are loaded with dependency injection support.

Methods
-------

The interface defines the following methods:

- [`execute()`](#execute)

<a name="execute" id="execute"></a>
<a name="execute" id="execute"></a>
### `execute()`

#### Signature

- It returns a `Stmt_Namespace\DiagnosticResult` value.

