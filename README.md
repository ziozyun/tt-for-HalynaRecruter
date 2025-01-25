# Розгортання

1. Потрібно заповнити ```TELEGRAM_BOT_TOKEN```, ```TELEGRAM_CHAT_ID```, ```GOOGLE_SHEET_SPREADSHEET_ID```, ```GOOGLE_SHEET_ACCESS_TOKEN```, ```GOOGLE_SHEET_RANGE``` в ```.env```
2. ```make up``` - Запустити контейнери
3. ```make install``` - Встановити залежності
4. ```make queue``` - Запустити чергу (потрібно для сповіщення в Telegram + додавання в гугл табличку)
