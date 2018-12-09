#!/usr/bin/env bash

php ./console/yii gii/model \
    --tableName=* \
    --overwrite=1 \
    --color=1 \
    --interactive=0 \
    --generateLabelsFromComments=1 \
    --ns=common\\\models\\\generated \
    --queryNs=common\\\models\\\generated\\query \
    --baseClass=\\\yii\\\db\\\ActiveRecord \
    --queryBaseClass=\\\yii\\\db\\\ActiveQuery \
    --generateQuery=1 \
    --enableI18N=1 \
    --messageCategory=app
