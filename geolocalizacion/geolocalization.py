from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.firefox.service import Service  # Cambiar a Firefox
from selenium.webdriver.firefox.options import Options  # Cambiar a Firefox
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from bs4 import BeautifulSoup
import time

# Configuración de Firefox
firefox_options = Options()

# Configuraciones para Firefox
firefox_options.add_argument("--headless")  # Ejecutar en modo headless (sin interfaz gráfica)
firefox_options.add_argument("--disable-gpu")  # Deshabilitar la GPU
firefox_options.add_argument("--no-sandbox")  # Deshabilitar el sandbox

# Ignorar errores de certificados SSL
firefox_options.set_preference("network.http.use-cache", False)
firefox_options.set_preference("security.enterprise_roots.enabled", True)
firefox_options.set_preference("security.cert_pinning.enforcement_level", 0)
firefox_options.set_preference("network.stricttransportsecurity.preloadlist", False)
firefox_options.set_preference("browser.xul.error_pages.expert_bad_cert", True)
firefox_options.set_preference("webdriver_accept_untrusted_certs", True)
firefox_options.set_preference("webdriver_assume_untrusted_issuer", True)

# Ruta al geckodriver (asegúrate de tener el geckodriver instalado y en la ruta correcta)
service = Service('C:\\herramientas\\geckodriver.exe')  # Cambia esto a la ruta de tu geckodriver

# Inicializar el navegador Firefox
driver = webdriver.Firefox(service=service, options=firefox_options)

try:
    # Acceder a la página
    driver.get("https://www.cual-es-mi-ip.net/geolocalizar-ip-mapa/191.88.248.227")
    
    # Esperar a que la página cargue completamente
    time.sleep(3)
    
    # Cerrar el modal de GDPR si está presente
    try:
        # Esperar a que el modal de GDPR esté visible
        gdpr_modal = WebDriverWait(driver, 10).until(
            EC.visibility_of_element_located((By.CLASS_NAME, "gaz-gdpr-modal__container"))
        )
        
        # Hacer clic en el botón de aceptar cookies o cerrar el modal
        accept_button = gdpr_modal.find_element(By.XPATH, ".//button[contains(text(), 'Aceptar')]")
        accept_button.click()
        
        # Esperar a que el modal desaparezca
        WebDriverWait(driver, 10).until(
            EC.invisibility_of_element_located((By.CLASS_NAME, "gaz-gdpr-modal__container"))
        )
    except Exception as e:
        print("No se encontró el modal de GDPR o no se pudo cerrar:", e)
    
    # Presionar el botón "Geolocalizar" por su ID
    geolocalizar_button = WebDriverWait(driver, 10).until(
        EC.element_to_be_clickable((By.ID, "grid--geolocation--button"))
    )
    geolocalizar_button.click()
    
    # Esperar a que la geolocalización se complete
    time.sleep(5)
    
    # Obtener el contenido de la página después de la geolocalización
    page_source = driver.page_source
    
    # Analizar el contenido con BeautifulSoup
    soup = BeautifulSoup(page_source, 'html.parser')
    
    # Guardar el HTML completo en un archivo de texto
    with open("html_completo.txt", "w", encoding="utf-8") as file:
        file.write(soup.prettify())  # Escribir el HTML formateado en el archivo
    
    print("El HTML se ha guardado en 'html_completo.txt'.")
    
    # Función para extraer datos de manera segura
    def extract_data(soup, tag, element_id):
        element = soup.find(tag, {"id": element_id})
        return element.text.strip() if element else "No encontrado"
    
    # Extraer los datos requeridos
    ip_address = extract_data(soup, "td",  "geo--map--whois")
    city = extract_data(soup, "td", "geo--map--city")
    postal_code = extract_data(soup, "td", "geo--map--postal-code")
    country = extract_data(soup, "span", "geo--map--country")
    timezone = extract_data(soup, "td", "geo--map--timezone")
    latitude = extract_data(soup, "td", "geo--map--latitude")
    longitude = extract_data(soup, "td", "geo--map--longitude")
    organization = extract_data(soup, "td", "geo--map--org")
    asn = extract_data(soup, "td", "geo--map--asn")
    
    # Imprimir los datos
    print(f"ip: {ip_address}")
    print(f"Ciudad: {city}")
    print(f"Código Postal: {postal_code}")
    print(f"País: {country}")
    print(f"Zona horaria: {timezone}")
    print(f"Latitud: {latitude}")
    print(f"Longitud: {longitude}")
    print(f"Organización: {organization}")
    print(f"ASN: {asn}")

finally:
    # Cerrar el navegador
    driver.quit()