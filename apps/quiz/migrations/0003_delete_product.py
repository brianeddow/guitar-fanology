# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('quiz', '0002_auto_20160128_1941'),
    ]

    operations = [
        migrations.DeleteModel(
            name='Product',
        ),
    ]
