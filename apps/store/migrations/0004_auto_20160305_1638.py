# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('store', '0003_auto_20160305_1636'),
    ]

    operations = [
        migrations.AlterField(
            model_name='guitar',
            name='num_strings',
            field=models.CharField(max_length=1, choices=[(b'6', b'6 Strings'), (b'7', b'7 Strings'), (b'8', b'8 Strings')]),
        ),
    ]
