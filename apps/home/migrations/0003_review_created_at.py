# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations
import datetime


class Migration(migrations.Migration):

    dependencies = [
        ('home', '0002_auto_20160306_2208'),
    ]

    operations = [
        migrations.AddField(
            model_name='review',
            name='created_at',
            field=models.DateTimeField(default=datetime.datetime(2016, 3, 6, 22, 31, 37, 751000), verbose_name=b'Created At'),
        ),
    ]
