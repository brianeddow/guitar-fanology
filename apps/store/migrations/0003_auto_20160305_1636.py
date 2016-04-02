# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0002_auto_20160304_1737'),
    ]

    operations = [
        migrations.CreateModel(
            name='Guitar',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('num_strings', models.CharField(max_length=1, choices=[(b'6', 6), (b'7', 7), (b'8', 8)])),
            ],
        ),
        migrations.RemoveField(
            model_name='product',
            name='is_active',
        ),
        migrations.RemoveField(
            model_name='product',
            name='is_featured',
        ),
    ]
