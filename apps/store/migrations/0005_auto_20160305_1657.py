# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0004_auto_20160305_1638'),
    ]

    operations = [
        migrations.AddField(
            model_name='guitar',
            name='hollow_body',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='guitar',
            name='jumbo_frets',
            field=models.BooleanField(default=True),
        ),
        migrations.AddField(
            model_name='guitar',
            name='locking_nut',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='guitar',
            name='pickup_type',
            field=models.CharField(default=b'Humbucker', max_length=30),
        ),
    ]
