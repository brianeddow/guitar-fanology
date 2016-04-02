# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Review',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('name', models.CharField(max_length=100)),
                ('review', models.CharField(max_length=500)),
                ('rating', models.IntegerField(max_length=10)),
                ('suggestions', models.TextField()),
            ],
            options={
                'db_table': 'reviews',
            },
        ),
    ]
