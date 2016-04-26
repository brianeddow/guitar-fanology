# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0006_guitar_name'),
    ]

    operations = [
        migrations.AlterField(
            model_name='guitar',
            name='name',
            field=models.CharField(default=b'Guitar', max_length=30),
        ),
    ]
