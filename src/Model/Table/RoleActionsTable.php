<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoleActions Model
 *
 * @property \MakvilleAcl\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \MakvilleAcl\Model\Table\ModuleActionsTable&\Cake\ORM\Association\BelongsTo $ModuleActions
 *
 * @method \MakvilleAcl\Model\Entity\RoleAction get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\RoleAction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoleActionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('role_actions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'className' => 'MakvilleAcl.Roles',
        ]);
        $this->belongsTo('ModuleActions', [
            'foreignKey' => 'module_action_id',
            'className' => 'MakvilleAcl.ModuleActions',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('assigned_by')
            ->allowEmptyString('assigned_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['module_action_id'], 'ModuleActions'));

        return $rules;
    }
}
