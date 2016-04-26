# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0005_auto_20160305_1657'),
    ]

    operations = [
        migrations.AddField(
            model_name='guitar',
            name='name',
            field=models.CharField(default='Guitar', max_length=20),
            preserve_default=False,
        ),
    ]
