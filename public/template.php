<?php if(isStrictArrayKey($_POST, 'refresh', '1')): ?>
	<h1>Count has been refreshed</h1>
<?php endif; ?>

<form action="/" method="POST">
	<input type="hidden" value=1 name="refresh">
	<a href="/">Refresh</a>
	<button>Refresh Count</button>
</form>