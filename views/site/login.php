<h2>�����������</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
   ?>
   <form method="post">
       <label>����� <input type="text" name="login"></label>
       <label>������ <input type="password" name="password"></label>
       <button>�����</button>
   </form>
<?php endif;