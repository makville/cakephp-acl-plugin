<?php

namespace MakvilleAcl\PolicyResolver;

use Authorization\Policy\ResolverInterface;
use MakvilleAcl\Policy\AclDbPolicy;

class AclDbPolicyResolver implements ResolverInterface {

    public function getPolicy($resource) {
        return new AclDbPolicy();
    }

}
