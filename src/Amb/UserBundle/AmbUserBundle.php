<?php

namespace Amb\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AmbUserBundle extends Bundle
{
	public function getParent() {
		return 'FOSUserBundle';
	}
}
