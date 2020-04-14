<?php

declare(strict_types = 1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modules Model
 *
 * @property \MakvilleAcl\Model\Table\ModuleActionsTable&\Cake\ORM\Association\HasMany $ModuleActions
 *
 * @method \MakvilleAcl\Model\Entity\Module get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Module|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Module saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Module findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModulesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('modules');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Duties', [
            'foreignKey' => 'module_id',
            'className' => 'MakvilleAcl.Duties',
        ]);
        $this->hasMany('ModuleActions', [
            'foreignKey' => 'module_id',
            'className' => 'MakvilleAcl.ModuleActions',
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
                ->allowEmptyString('id', null, 'create');

        $validator
                ->scalar('name')
                ->maxLength('name', 255)
                ->allowEmptyString('name');

        $validator
                ->scalar('description')
                ->maxLength('description', 255)
                ->allowEmptyString('description');

        $validator
                ->scalar('version')
                ->maxLength('version', 255)
                ->allowEmptyString('version');

        return $validator;
    }

    public function configure ($configuration) {
        $duties = $configuration['duties'];
        unset($configuration['duties']);
        //Save the module
        $module = $this->newEntity($configuration);
        $this->save($module);
        //save the duties
        foreach ($duties as $dutyName => $actions) {
            $duty = $this->Duties->newEntity([
                'module_id' => $module->id,
                'name' => $dutyName
            ]);
            $this->Duties->save($duty);
            foreach ($actions as $actionName) {
                $action = $this->Duties->ModuleActions->newEntity([
                    'module_id' => $module->id,
                    'duty_id' => $duty->id,
                    'name' => $actionName
                ]);
                $this->Duties->ModuleActions->save($action);
            }
        }
    }
    
    public function remove ($id) {
        $module = $this->get($id, ['contain' => ['Duties' => ['ModuleActions']]]);
        foreach ($module->duties as $duty) {
            foreach ($duty->module_actions as $action) {
                //remove role actions
                $this->Duties->ModuleActions->RoleActions->deleteAll(['module_action_id' => $action->id]);
                //remove the action itself
                $this->Duties->ModuleActions->delete($action);
            }
            $this->Duties->delete($duty);
        }
        return $this->delete($module);
    }
}
