# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0007_auto_20160308_1314'),
    ]

    operations = [
        migrations.AddField(
            model_name='guitar',
            name='custom_tuners',
            field=models.BooleanField(default=False),
        ),
        migrations.AlterModelTable(
            name='guitar',
            table='guitars',
        ),
    ]
