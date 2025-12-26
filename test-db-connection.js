import mysql from 'mysql2/promise';

const config = {
    host: 'da1.eurodns.top',
    port: 3306,
    database: 'ebrahims_Website',
    user: 'ebrahims_Website',
    password: 'Hima0900856660@#@#$',
    connectTimeout: 10000,
    enableKeepAlive: true,
    keepAliveInitialDelay: 0,
};

console.log('🔍 محاولة الاتصال بقاعدة البيانات...');
console.log(`Host: ${config.host}`);
console.log(`Port: ${config.port}`);
console.log(`Database: ${config.database}`);
console.log(`User: ${config.user}`);
console.log(`Timeout: ${config.connectTimeout}ms`);
console.log('');

async function testConnection() {
    let connection;
    const startTime = Date.now();
    
    try {
        console.log('⏳ جاري الاتصال...');
        connection = await mysql.createConnection(config);
        const connectTime = Date.now() - startTime;
        console.log(`✅ الاتصال نجح! (${connectTime}ms)`);
        
        const [rows] = await connection.execute('SELECT 1 as test');
        console.log('✅ الاستعلام نجح!');
        
        const [tables] = await connection.execute('SHOW TABLES');
        console.log(`📋 عدد الجداول: ${tables.length}`);
        if (tables.length > 0) {
            console.log('   الجداول:');
            tables.forEach(table => {
                console.log(`   - ${Object.values(table)[0]}`);
            });
        }
        
        // اختبار استعلام إضافي
        const [dbInfo] = await connection.execute('SELECT DATABASE() as current_db, VERSION() as version');
        console.log(`\n📊 معلومات قاعدة البيانات:`);
        console.log(`   قاعدة البيانات الحالية: ${dbInfo[0].current_db}`);
        console.log(`   إصدار MySQL: ${dbInfo[0].version}`);
        
        console.log('\n✅ جميع الاختبارات نجحت!');
    } catch (error) {
        const elapsedTime = Date.now() - startTime;
        console.error('\n❌ خطأ في الاتصال:');
        console.error(`   الكود: ${error.code || 'UNKNOWN'}`);
        console.error(`   الرسالة: ${error.message}`);
        console.error(`   الوقت المنقضي: ${elapsedTime}ms`);
        
        if (error.code === 'ETIMEDOUT' || error.code === 'ECONNREFUSED') {
            console.error('\n💡 اقتراحات:');
            console.error('   1. تحقق من أن الخادم يعمل');
            console.error('   2. تحقق من إعدادات جدار الحماية');
            console.error('   3. تحقق من أن عنوان IP الخاص بك مسموح به');
            console.error('   4. تحقق من الاتصال بالإنترنت');
        } else if (error.code === 'ER_ACCESS_DENIED_ERROR') {
            console.error('\n💡 تحقق من اسم المستخدم وكلمة المرور');
        }
    } finally {
        if (connection) {
            try {
                await connection.end();
                console.log('\n🔌 تم إغلاق الاتصال');
            } catch (err) {
                // تجاهل أخطاء الإغلاق
            }
        }
    }
}

testConnection();
