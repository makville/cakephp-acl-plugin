<?php

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModuleActionGroups Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Modules
 * @property \Cake\ORM\Association\HasMany $ModuleActions
 *
 * @method \Acl\Model\Entity\ModuleActionGroup get($primaryKey, $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup newEntity($data = null, array $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup[] newEntities(array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \Acl\Model\Entity\ModuleActionGroup findOrCreate($search, callable $callback = null)
 */
class ModuleActionGroupsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('module_action_groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'className' => 'Acl.Modules'
        ]);
        $this->hasMany('ModuleActions', [
            'foreignKey' => 'module_action_group_id',
            'className' => 'Acl.ModuleActions'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->allowEmpty('name');

        $validator
                ->allowEmpty('description');

        $validator
                ->allowEmpty('handle');

        $validator
                ->allowEmpty('is_system');

        $validator
                ->allowEmpty('is_public');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn(['module_id'], 'Modules'));

        return $rules;
    }

    public function isUnique($moduleId, $name, $isSystem, $signature) {
        if ($this->find()->where(['module_id' => $moduleId, 'name' => $name])->count() == 0) {
            return true;
        }
        //confirm system status
        $groupEntity = $this->find()->where(['module_id' => $moduleId, 'name' => $name])->first();
        $groupEntity->signature = $signature;
        if ($groupEntity->is_system != $isSystem) {
            $groupEntity->is_system = $isSystem;
        }
        $this->save($groupEntity);
        return false;
    }

    public function saveGroup($moduleEntity, $group, $signature) {
        $isSystem = 0;
        if (!(strpos($group, '-system') === false)) {
            $isSystem = 1;
        }
        $group = $this->reformatName($group);
        if ($this->isUnique($moduleEntity->id, $group, $isSystem, $signature)) {
            $groupEntity = $this->newEntity(['module_id' => $moduleEntity->id, 'name' => $group, 'handle' => strtolower($moduleEntity->name . ".$group"), 'is_system' => $isSystem, 'signature' => $signature]);
            $this->save($groupEntity);
        }
        return $groupEntity = $this->Modules->ModuleActionGroups->find()->where(['module_id' => $moduleEntity->id, 'name' => $group])->first();
    }

    public function isSystem($path) {
        $dir = new DirectoryIterator($path);
        foreach ($dir as $file) {
            if ($file->getFilename() == 'system') {
                return true;
            }
        }
        return false;
    }

    public function isPublic($path) {
        $dir = new DirectoryIterator($path);
        foreach ($dir as $file) {
            if ($file->getFilename() == 'public') {
                return true;
            }
        }
        return false;
    }

    private function reformatName($name) {
        if (strpos($name, '-system') === false) {
            return $name;
        }
        return explode('-', $name)[0];
    }

    public function purge($signature) {
        return $this->deleteAll([function($exp) use ($signature) {
                        return $exp->not(['signature' => $signature]);
                    }]
                );
    }
}
        
