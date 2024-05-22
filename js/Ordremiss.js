function imprimerPage() {
    window.print();
}

function convertToPDF() {
    // Créer un nouvel objet jsPDF
    const doc = new jsPDF();

    // Récupérer les valeurs des champs du formulaire
    const nom_prenom = document.getElementById('nom_prenom').value;
    const matricule = document.getElementById('matricule').value;
    const adress_admin = document.getElementById('adress_admin').value;
    const fonction = document.getElementById('fonction').value;
    const moyen_deplacement = document.getElementById('moyen_deplacement').value;
    const emplacement = document.getElementById('emplacement').value;
    const raison = document.getElementById('raison').value;
    const date_dep = document.getElementById('date_dep').value;
    const date_ret = document.getElementById('date_ret').value;

    // Ajouter le contenu au PDF
    doc.text(20, 20, `Nom et Prénom: ${nom_prenom}`);
    doc.text(20, 30, `Matricule: ${matricule}`);
    doc.text(20, 40, `Adresse administratif: ${adress_admin}`);
    doc.text(20, 50, `Fonction: ${fonction}`);
    doc.text(20, 60, `Moyen de déplacement: ${moyen_deplacement}`);
    doc.text(20, 70, `Destination: ${emplacement}`);
    doc.text(20, 80, `Motif: ${raison}`);
    doc.text(20, 90, `Date de déplacement: ${date_dep}`);
    doc.text(20, 100, `Date de retour: ${date_ret}`);

    // Télécharger le PDF
    doc.save('formulaire.pdf');
}