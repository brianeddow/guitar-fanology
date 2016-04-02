# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0008_auto_20160308_1317'),
    ]

    operations = [
        migrations.RenameField(
            model_name='guitar',
            old_name='custom_tuners',
            new_name='custom_tuner_keys',
        ),
    ]
