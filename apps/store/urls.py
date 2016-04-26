from django.conf.urls import patterns, url
from . import views

urlpatterns = patterns('',
	url(r'^$', views.index, name='index'),
	url(r'^products/$', views.products, name='products'),
	url(r'^new_product/$', views.new_product, name='new_product'),
	url(r'^add_product/$', views.add_product, name='add_product'),
	url(r'^show/(?P<question_id>\d+)/$', views.show, name='show'),
	url(r'^show_more/$', views.show_more, name='show_more'),
	url(r'^contact/$', views.contact_form, name='contact_form'),
	url(r'^submit_contact_form/$', views.submit_contact_form, name='submit_contact_form'),
)