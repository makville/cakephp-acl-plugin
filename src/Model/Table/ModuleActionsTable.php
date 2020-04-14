<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModuleActions Model
 *
 * @property \MakvilleAcl\Model\Table\ModulesTable&\Cake\ORM\Association\BelongsTo $Modules
 * @property \MakvilleAcl\Model\Table\DutiesTable&\Cake\ORM\Association\BelongsTo $Duties
 * @property \MakvilleAcl\Model\Table\RoleActionsTable&\Cake\ORM\Association\HasMany $RoleActions
 *
 * @method \MakvilleAcl\Model\Entity\ModuleAction get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\ModuleAction findOrCreate($search, callable $callback = null, $options = [])
 */
class ModuleActionsTable extends Table
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

        $this->setTable('module_actions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'className' => 'MakvilleAcl.Modules',
        ]);
        $this->belongsTo('Duties', [
            'foreignKey' => 'duty_id',
            'className' => 'MakvilleAcl.Duties',
        ]);
        $this->hasMany('RoleActions', [
            'foreignKey' => 'module_action_id',
            'className' => 'MakvilleAcl.RoleActions',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->scalar('handle')
            ->maxLength('handle', 255)
            ->allowEmptyString('handle');

        $validator
            ->scalar('ownership_check')
            ->allowEmptyString('ownership_check');

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
        $rules->add($rules->existsIn(['module_id'], 'Modules'));
        $rules->add($rules->existsIn(['duty_id'], 'Duties'));

        return $rules;
    }
}
