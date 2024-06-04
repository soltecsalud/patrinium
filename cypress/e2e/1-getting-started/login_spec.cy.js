describe('Login Test', () => {
  before(() => {
    // Navega a la página de inicio de sesión
    cy.visit('http://localhost/patrinium/');
    
    // Espera a que jQuery esté disponible
    cy.window().should('have.property', '$');
  });

  it('should display the login page', () => {
    // Verifica que la página de inicio de sesión se muestra correctamente
    cy.contains('Inicia Sesión').should('be.visible');
  });

  it('should allow the user to log in', () => {
    // Rellena el formulario de inicio de sesión
    cy.get('input[name="usuarioLogin"]').type('CarlosMata');  // Ajusta el nombre del campo si es necesario
    cy.get('input[name="contrasenaLogin"]').type('12345');  // Ajusta el nombre del campo si es necesario

    // Haz clic en el botón de inicio de sesión
    cy.get('button[type="submit"]').click();

    // Verifica que la página redirige a la página principal o muestra el mensaje de bienvenida
    cy.url().should('include', '/dashboard'); // Ajusta esto según la URL de redirección esperada
    cy.contains('Bienvenido, testuser').should('be.visible'); // Ajusta esto según el contenido esperado
  });
});
  