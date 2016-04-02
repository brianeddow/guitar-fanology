from django.conf.urls import patterns, url
from . import views
urlpatterns = patterns('',
	url(r'^$', views.index, name='index'),
	url(r'^question/$', views.question, name='question'),
	url(r'^add_question/$', views.add_question, name='add_question'),
	url(r'^show_questions/$', views.show_questions, name='show_questions'),
	url(r'^choice/(?P<question_id>\d+)$', views.choice, name='choice'),
	url(r'^add_choice/(?P<question_id>\d+)$', views.add_choice, name='add_choice'),
	url(r'^show/(?P<question_id>\d+)/$', views.show, name='show'),
)