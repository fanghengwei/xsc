<?php
echo '<pre>';
print_r(exec("git -c diff.mnemonicprefix=false -c core.quotepath=false --no-optional-locks pull --no-commit origin master"));
exit('</pre>');

?>