<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Sample translation file for Kohanut.  Copy this file and rename it to your two
 * letter language code, and translate the messages.  Be sure to put your name in
 * the author field, and which version of kohanut this is compatable with. Feel
 * free to push your language files to http://github.com/bluehawk/kohanut-core
 *
 * I do not speak spanish. Don't get mad at me if this is nonsense :)
 * 
 * @author     Google Translate, Michael Peters
 * @version    0.6.1
 */
return array
(
	// Installation
	'Install Kohanut' => 'Установка Kohanut',
	'You should have your database settings put into :config or this will fail.' => 'Задайте настройки подключения к БД в :config, или ничего у нас не получится.',
	'Set your admin password:' => 'Задайте пароль администратора:',
	'Repeat password:' => 'Повторите пароль:',
	'Install' => 'Установка',
	'Success' => 'Успешно',
	'Installed successfully! Be sure to delete or rename the folder :installer' => 'Установка завершена! Удалите или переименуйте папку :installer',

	// General/login
	'Error:' => 'Ошибка:',
	'Admin' => 'Админка',
	'Help' => 'Помощь',
	'Logged in as :user' => 'Вошел как :user',
	'Visit Site' => 'Посетить сайт',
	'Login' => 'Войти в систему',
	'Username:' => 'Имя:',
	'Password:' => 'Пароль:',
	'Logout' => 'Выйти из системы',
	'Save Changes' => 'Сохранить изменения',
	'cancel' => 'отмена',
	'view' => 'смотреть',
	'edit' => 'править',
	'move' => 'переместить',
	'add' => 'добавить',
	'delete' => 'удалить',
	'test' => 'проверить',
	'Click to edit' => 'Нажмите для редактирования',
	'Click to delete' => 'Нажмите для удаления',
	'Click to test' => 'Нажмите для проверки',
	'Name' => 'Имя',
	'Description' => 'Описание',
	'Content' => 'Содержание',
	'Code' => 'Код',
	'Change Language' => 'Сменить язык',
	'Updated Successfully' => 'Успешно обновлено',
	
	// Pages
	'Pages' => 'Страницы',
	'Loading...' => 'Загрузка...',
	'(Link)' => '(Ссылка)',
	'Click to view page' => 'Нажмите для просмотра страницы',
	'Click to edit page' => 'Нажмите для редактирования страницы',
	'Click to move page' => 'Нажмите для перемещения страницы',
	'Click to add sub-page' => 'Нажмите для создания дочерней страницы',
	'Click to delete page' => 'Нажмите для удаления страницы',
	'Create a new page' => 'Как создать новую страницу',
	'To create a new page, hover over the parent, or the page you want the new page to be under, and click on "add".' => 'Чтобы создать новую страницу, выберите ее предка, и нажмите &laquo;добавить&raquo;',
	'Edit a page' => 'Как отредактировать страницу',
	'To edit a page, hover over it, and click "edit".' => 'Чтобы отредактировать страницу, выделите ее и нажмите &laquo;редактировать&raquo;',
	'Delete a page' => 'Как удалить страницу',
	'To delete a page, hover over it and click "delete". You will be asked to confirm before the page is deleted.' => 'Чтобы удалить страницу, выделите ее и нажмите &laquo;удалить&raquo;. Затем подтвердите удаление страницы.',
	'Move a page' => 'Как переместить страницу',
	'To move a page (and all of its children, if it has any), hover over it and click "move".' => 'Для перемещения страницы (и всех ее дочерних страниц), выделите ее и нажмите &laquo;переместить&raquo;.',
	'View a page' => 'Как просмотреть страницу',
	'To view what a pages looks like, hover over it and click "view".' => 'Чтобы посмотреть, как выглядит страница, выделите ее и нажмите &laquo;смотреть&raquo;',
	// Edit Page
	'Back' => 'Назад',
	'You are editing :page' => 'Вы редактируете :page',
	'Edit meta data' => 'Редактирование метаданных',
	'Element Area #:num - :name' => 'Элемент #:num - :name',
	'Add New Element' => 'Добавить новый элемент',
	'Add Element' => 'Добавить элемент',
	'Edit' => 'Редактировать',
	'Move Up' => 'Поднять', // TODO проверить
	'Move Down' => 'Опустить', // TODO проверить
	'Delete' => 'Удалить',
	// Add Page / Edit Meta Data
	'Adding New Page' => 'Добавление новой страницы',
	'Adding a sub page to ":page".' => 'Добавление дочерней страницы для ":page".',
	'Editing Page:' => 'Редактирование страницы:',
	'This is an external link, meaning it is not actually a page managed by this system, but rather it links to a page somewhere else.  To change it to a page that you can control here, uncheck "External Link" below.' => 'Это внешняя ссылка. Она не контролируется системой, а ведет куда-то еще. Чтобы превратить ее в документ, уберите галочку &laquo;Внешняя ссылка&raquo;',
	'Edit Page Content' => 'Редактирование содержания страницы',
	'Click to edit this page\'s content' => 'Нажмите, чтобы редактировать содержание страницы',
	'Location' => 'Расположение',
	'Where in the list of siblings this page will appear.' => 'Позиция страницы среди других страниц того же уровня вложенности',
	'First Child' => 'Первой',
	'After :child' => 'После :child',
	'Last Child' => 'Последней',
	'Navigation Name' => 'Название для навигации',
	'This is the name that shows up in the navigation.' => 'Имя, под которым страница отображается в меню.',
	'URL' => 'Ссылка',
	'This is the "link" to the page, or whats in the address bar.' => 'Это ссылка на страницу, - то, что вы увидите в строке адреса.',
	'If you are seeing this text, you might have javascript disabled.' => 'Если вы видите этот текст, - то у вас отключен JavaScript.',
	'This will link to:' => 'Ссылка на:',
	'This page will have the URL:' => 'Ссылка на страницу будет:',
	'External Link' => 'Внешняя ссылка',
	'Checking this will mean you can\'t edit this page here, it simply links to the URL above.' => 'Если выбрано, страницу невозможно отредактировать в админке, это просто перенаправление на другой адрес.',
	'Show in Navigation' => 'Показывать в меню',
	'Check this to have this page show in the navigation menus.' => 'Нужно ли показывать эту страницу в меню сайта.',
	'Show in Site Map' => 'Показывать в карте сайта',
	'Check this to have this page show in the site map.' => 'Нужно ли показывать эту страницу в карте сайта.',
	'Page Meta Data' => 'Метаданные страницы',
	'Title' => 'Название',
	'This is what shows up at the top of the window or tab.' => 'Текст, который отображается в заголовке окна или вкладки.',
	'Meta Keywords' => 'Ключевые слова',
	'Keywords are used by search engines to find and rank your page.' => 'Ключевые слова могут использоваться поисковыми системами.',
	'Meta Description' => 'Описание страницы',
	'This is used by search engines to summarize your page for visitors.' => 'Описание страницы может использоваться поисковыми системами для подготовки краткого описания страницы для посетителей.',
	'Layout' => 'Макет',
	'Which layout this page should use.' => 'Какой макет использовать для отображения страницы',
	'Create Page' => 'Создать страницу',
	// Move Page
	'Move Page' => 'Переместить страницу',
	'Move ":page" to' => 'Переместить страницу ":page"',
	'before' => 'перед',
	'after' => 'после',
	'first child of' => 'первой дочерней для',
	'last child of' => 'последней дочерней для',
	'To move this page to a new location, use the drop downs to choose the new location for the page.<br/><br/>This will move the page, and all of its children to the new location.<br/><br/>Example: If you selected "before" and "Products" the page would be moved to before Products.' => 'Чтобы переместить страницу в новое место, используйте выпадающие списки для выбора нового расположения страницы.<br/>После этого, страница и все ее дочерние страницы переместятся в новое место.<br/>Например, если выбрать &laquo;Перед&raquo; и &laquo;Products&raquo;, страница будет помещена перед страницей Продуктов.',

	// Delete Page
	'Delete Page' => 'Удаление страницы',
	'Are you sure you want to delete the page ":page"?' => 'Вы уверены, что хотите удалить страницу ":page"?',
	'This is not reversible!' => 'Это действие невозможно отменить!',
	'This page has children. Deleting it will delete all children too. Are you really sure you want to do this?' => 'У страницы есть дочерние страницы. После ее удаления, они также будут безвозвратно удалены. Вы уверены, что хотите удалить страницу и все ее дочерние страницы?',
	'Yes, delete it.' => 'Да, удаляй.',
	
	// Elements
	'Adding :element' => 'Добавить :element',
	'Select a :element' => 'Выделить :element',
	'Editing :element' => 'Редактировать :element',
	'Delete :element' => 'Удалить :element',
	'Are you sure you want to delete this element?' => 'Вы уверены, что хотите удалить этот элемент?',
	'This will permanently delete everything inside this element!' => 'Все содержимое элемента будет удалено. Это действие необратимо!',
	'This will not delete the actual element, just remove it from this page.' => 'Элемент будет удален лишь с этой страницы.',

	// Snippets
	'Snippet' => 'Фрагмент',
	'Snippets' => 'Фрагменты',
	'No Snippets found.' => 'Нету фрагментов.',
	'Create a New Snippet' => 'Создать новый фрагмент',
	'Edit Snippet' => 'Редактировать фрагмент',
	'Enable :Markdown' => 'Использовать :Markdown',
	'Enable :Twig' => 'Использовать :Twig',
	'Create Snippet' => 'Создать фрагмент',
	'Delete Snippet' => 'Удалить фрагмент',
	'Are you sure you want to delete the snippet ":name"?' => 'Вы уверены, что хотите удалить фрагмент &laquo;:name&raquo;?',

	// Layouts
	'Layouts' => 'Макеты',
	'No layouts found' => 'Нету макетов.',
	'Create a New Layout' => 'Создать новый макет',
	'Edit Layout' => 'Редактировать макет',
	'Create Layout' => 'Создать макет',
	'Delete Layout' => 'Удалить макет',
	'Are you sure you want to delete the layout ":name"?' => 'Вы уверены, что хотите удалить макет &laquo;:name&raquo;?',
	
	// Users
	'Users' => 'Пользователи',
	'No users found' => 'Нету пользователей',
	'Create a New User' => 'Создать пользователя',
	'Edit User' => 'Редактировать пользователя',
	'Create User' => 'Создание пользователя',
	'User Name' => 'Имя пользователя',
	'Password' => 'Пароль',
	'Repeat Password' => 'Повторите пароль',
	'Delete User' => 'Удалить пользователя',
	'Are you sure you want to delete the user ":name"?' => 'Вы уверены, что хотите удалить пользователя &laquo;:name&raquo;?',

	// Redirects
	'Redirects' => 'Редиректы',
	'permanent' => 'постоянный',
	'temporary' => 'временный',
	'No redirects found' => 'Нету редиректов',
	'Create a New Redirect' => 'Создать новый редирект',
	'What are redirects?' => 'Что такое редиректы?',
	'You should add a redirect if you move a page or a site, so links on other sites do not break, and search engine rankings are preserved.<br/><br/>When a user types in the outdated link, or clicks on an outdated link, they will be taken to the new link.<br/><br/>Redirect type should be permanent (301) in most cases, as this helps to preserve search engine rankings better. Leave it as permanent unless you know what you are doing.' => 'Редирект нужен, если вы перемещаете страницу или сайт. Ссылки с других сайтов, ведущие на перемещенную страницу, будут работать. Поисковые позиции не изменятся.<br/>Когда пользователь перейдет по устаревшей ссылке, он будет автоматически перенаправлен по новому адресу.<br/>В большинстве случаев следует выбирать &laquo;постоянный&raquo; (301) тип редиректа: он кэшируется в браузере пользователя, а также позволяет сохранить позиции в поисковиках. Используйте постоянный редирект, если у вас нет веской причины использовать временный.',
	'Old URL' => 'Старый адрес',
	'When someone goes to this URL...' => 'Когда кто-то идет по этому адресу...',
	'New URL' => 'Новый адрес',
	'...they will be taken to this URL.' => '...он попадет на этот адрес.',
	'Redirect Type' => 'Тип редиректа',
	'This should be permanent (301), unless you know what you are doing.' => 'Выберите &laquo;постоянный&raquo;, если не знаете, чем они отличаются',
	'Create Redirect' => 'Создать редирект',
	'Edit Redirect' => 'Редактировать редирект',
	'Delete Redirect' => 'Удалить редирект',
	'Are you sure you want to delete the redirect from ":url" to ":newurl"?' => 'Вы уверены, что хотите удалить редирект с ":url" на ":newurl"?',

	// Validate errors
	':field must not be empty' => ':field не может быть пустым',
	':field must be the same as :param1' => ':field должен быть таким же, как и :param1',
	':field does not match the required format' => ':field имеет неверный формат',
	':field must be exactly :param1 characters long' => ':field должно быть длиной ровно :param1 символов',
	':field must be at least :param1 characters long' => ':field должно быть не короче :param1 символов',
	':field must be less than :param1 characters long' => ':field должно быть короче :param1 символов',
	':field must be one of the available options' => ':field должно быть одним из перечисленных вариантов',
	':field must be a digit' => ':field должно быть цифрой',
	':field must be a decimal with :param1 places' => ':field должно быть числом с :param1 позициями',
	':field must be within the range of :param1 to :param2' => ':field должно быть числом от :param1 до :param2',
	
	// Kohanut specific errors (found in modules/kohanut/messages/kohanut.php)
	'The username or password you entered is incorrect.' => 'Имя пользователя или пароль указаны неверно.',
	
	// Errors
	'Couldn\'t find block ID :id.' => 'Невозможно найти блок с ID :id.',
	'Elementtype :type could not be loaded.' => 'Тип элемента :type не может быть загружен.',
	':type with ID :id could not be found.' => ':type с ID :id не найден.',
	'Could not find layout with ID :id.' => 'Не найден макет с ID :id.',
	'Delete failed! This is most likely caused because this template is still being used by one or more pages.' => 'Удалить не получилось! Наиболее вероятная причина: этот шаблон все еще используется на одной или нескольких страницах.',
	'Could not find page with ID :id.' => 'Страница с ID :id не найдена.',

	// Website elements
	'Contact Us' => 'Форма для связи',
	'Name:' => 'Имя:',
	'Email:' => 'Почта:',
	'Comments:' => 'Комментарий:',
	'Send Comments' => 'Отправить',
);