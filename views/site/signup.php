<h2>����������� ������ ������������</h2>
<pre><?= $message ?? ''; ?></pre>
<form method="post">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label>��� <input type="text" name="name"></label>
   <label>����� <input type="text" name="login"></label>
   <label>������ <input type="password" name="password"></label>
   <button>������������������</button>
</form>
