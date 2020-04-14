<?php

namespace MakvilleAcl\PolicyResolver;

use Authorization\Policy\ResolverInterface;
use MakvilleAcl\Policy\AclJsonPolicy;

class AclJsonPolicyResolver implements ResolverInterface {

    public function getPolicy($resource) {
        return new AclJsonPolicy();
    }

}
