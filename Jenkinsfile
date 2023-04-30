pipeline {
   agent any
  
  environment {
    MYSQL_HOST          = 'db'
    MYSQL_USER          = 'root'
    MYSQL_PASSWORD      = 'Abhishek@123'
    MAGENTO_URL         = 'http://local.secondp.com'
  }
  
  stages {
  
    stage('clean WS') {
      steps {
      	cleanWs() 
      }
    }
    
    stage('PHP Code Scan') {
      steps {
        echo 'php Syntax check'
        sh 'php -l app/'
        
      	// create folder to save report output
      	sh 'mkdir -p build/reports'
      	
      	// phpCS()
      	phpUnit()
      	
      }
    }		
    
    stage('SonarQube Scan') {
      steps {
       script {
      		scannerHome = tool 'SonarScanner 4.7'
      	}
      	withSonarQubeEnv(installationName: 'SonarQube') {

      	 sh """/home/abhishek/.sonar/sonar-scanner-4.7.0.2747-linux/bin/sonar-scanner \
      	-Dsonar.projectKey=firstp \
  	-Dsonar.projectBaseDir=/var/lib/jenkins/workspace/firstp/app/code \
  	-Dsonar.sources[]=/var/lib/jenkins/workspace/firstp/app/code/Webkul/Grid/Model \
  	-Dsonar.sources[]=/var/lib/jenkins/workspace/firstp/app/code/Webkul/Grid/Controller \
  	-Dsonar.php.coverage.reportPaths=/var/lib/jenkins/workspace/firstp/build/reports/coverage.xml \
  	-Dsonar.php.tests.reportPath=/var/lib/jenkins/workspace/firstp/build/reports/exceution-reports.xml \
  	-Dsonar.login=sqp_d32308828005ebaedf2a6a40fc52ce7dfd43a0f6 \
  	-Dsonar.host.url=http://localhost:9000
      	 """	
      	}
      	
      }
    }
    
      
      
    stage('Deploy Code') {
          steps {
            deployCode()
          }
        }
        
    } 
}

def phpCS() {
 echo "start php unit";
 sh './vendor/squizlabs/php_codesniffer/bin/phpcs --config-set installed_paths vendor/magento/magento-coding-standard'
 
 sh './vendor/squizlabs/php_codesniffer/bin/phpcs -d memory_limit=-1 --report=checkstyle --report-file=`pwd`/build/reports/checkstyle.xml --standard=Magento2 --warning-severity=0 --extensions=php,js,phtml app || exit 0'
 
}

def phpUnit() {
 echo "start php unit";
 sh './vendor/bin/phpunit -d memory_limit=-1 --testdox-html `pwd`/build/reports/phpunit.html -c `pwd`/dev/tests/unit/phpunit.xml.dist app/code/ --coverage-clover `pwd`/build/reports/coverage.xml --log-junit=`pwd`/build/reports/exceution-reports.xml'
}

def cleanWs() {
 echo "cleanWs";
}

def deployCode() {
 sh '''
 #php /usr/local/bin/composer install --no-dev
 echo "start magento command"
 #php -d memory_limmit=-1 bin/magento setup:upgrade
 #php -d memory_limmit=-1 bin/magento setup:di:compile
 
 	#	-Dsonar.sources=/var/lib/jenkins/workspace/firstp/app/code/ \
      # -Dsonar.exclusions=/var/lib/jenkins/workspace/firstp/app/code/Webkul/Grid/Block \
      
 '''
}


