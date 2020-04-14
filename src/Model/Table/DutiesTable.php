<?php
declare(strict_types=1);

namespace MakvilleAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Duties Model
 *
 * @property \MakvilleAcl\Model\Table\ModulesTable&\Cake\ORM\Association\BelongsTo $Modules
 *
 * @method \MakvilleAcl\Model\Entity\Duty get($primaryKey, $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty newEntity($data = null, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty[] newEntities(array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty[] patchEntities($entities, array $data, array $options = [])
 * @method \MakvilleAcl\Model\Entity\Duty findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DutiesTable extends Table
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

        $this->setTable('duties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'className' => 'MakvilleAcl.Modules',
        ]);
        $this->hasMany('ModuleActions', [
            'foreignKey' => 'duty_id',
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

        return $rules;
    }
}
