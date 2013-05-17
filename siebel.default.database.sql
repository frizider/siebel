-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 17 mei 2013 om 11:57
-- Serverversie: 5.5.27
-- PHP-versie: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `siebel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `priority` int(1) NOT NULL,
  `category` int(11) NOT NULL,
  `global` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delete` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments_categories`
--

CREATE TABLE IF NOT EXISTS `comments_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deliverydays`
--

CREATE TABLE IF NOT EXISTS `deliverydays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(250) NOT NULL,
  `address_id` int(11) NOT NULL,
  `monday_am_from` varchar(250) NOT NULL,
  `monday_am_to` varchar(250) NOT NULL,
  `monday_pm_from` varchar(250) NOT NULL,
  `monday_pm_to` varchar(250) NOT NULL,
  `tuesday_am_from` varchar(250) NOT NULL,
  `tuesday_am_to` varchar(250) NOT NULL,
  `tuesday_pm_from` varchar(250) NOT NULL,
  `tuesday_pm_to` varchar(250) NOT NULL,
  `wednesday_am_from` varchar(250) NOT NULL,
  `wednesday_am_to` varchar(250) NOT NULL,
  `wednesday_pm_from` varchar(250) NOT NULL,
  `wednesday_pm_to` varchar(250) NOT NULL,
  `thursday_am_from` varchar(250) NOT NULL,
  `thursday_am_to` varchar(250) NOT NULL,
  `thursday_pm_from` varchar(250) NOT NULL,
  `thursday_pm_to` varchar(250) NOT NULL,
  `friday_am_from` varchar(250) NOT NULL,
  `friday_am_to` varchar(250) NOT NULL,
  `friday_pm_from` varchar(250) NOT NULL,
  `friday_pm_to` varchar(250) NOT NULL,
  `monday_close` int(1) NOT NULL,
  `monday_delivery` int(1) NOT NULL,
  `tuesday_close` int(1) NOT NULL,
  `tuesday_delivery` int(1) NOT NULL,
  `wednesday_close` int(1) NOT NULL,
  `wednesday_delivery` int(1) NOT NULL,
  `thursday_close` int(1) NOT NULL,
  `thursday_delivery` int(1) NOT NULL,
  `friday_close` int(1) NOT NULL,
  `friday_delivery` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deliveryterms`
--

CREATE TABLE IF NOT EXISTS `deliveryterms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(250) NOT NULL,
  `term` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `asw_field` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formulas`
--

CREATE TABLE IF NOT EXISTS `formulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formulaname` varchar(250) NOT NULL,
  `formula` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'master', 'Master Administrator'),
(2, 'superadmin', 'Super Administrator');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(250) NOT NULL,
  `from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `until` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nl` text CHARACTER SET utf8 NOT NULL,
  `fr` text CHARACTER SET utf8 NOT NULL,
  `de` text CHARACTER SET utf8 NOT NULL,
  `en` text CHARACTER SET utf8 NOT NULL,
  `short` varchar(250) CHARACTER SET utf8 NOT NULL,
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`short`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=266 ;

--
-- Gegevens worden uitgevoerd voor tabel `language`
--

INSERT INTO `language` (`id`, `nl`, `fr`, `de`, `en`, `short`, `delete`) VALUES
(1, 'profiel', 'profil', 'Profil', 'profile', 'profil', 0),
(2, 'afwerking', 'couleur', 'Nachbewerkung', 'finish', 'finish', 0),
(3, 'klant', 'client', 'Kunde', 'customer', 'customer', 0),
(4, 'klantnummer', 'num&#233;ro de client', 'Kundennummer', 'customer number', 'customernumber', 0),
(5, 'omhulsel', 'enrobage', 'HÃ¼lle', 'casing', 'casing', 0),
(6, 'onderkant', 'sol', 'Boden', 'bottom', 'bottom', 0),
(7, 'lengte', 'longueur', 'LÃ¤nge', 'length', 'length', 0),
(8, 'breedte', 'largeur', 'Breite', 'width', 'width', 0),
(9, 'hoogte', 'hauteur', 'HÃ¶he', 'height', 'height', 0),
(10, 'tussenlaag', 'entre les couches', 'zwischen die Lagen', 'interlayer', 'interlayer', 0),
(11, 'formaat incl hout', 'format incluant le bois', 'Abmessungen einschlieÃŸlich Holz', 'format including wood', 'wood', 0),
(12, 'omgekeerd in/op elkaar', 'inversement &#224; / sur l''autre', 'umgekehrt ineinander / aufeinander', 'reversed in / on each other', 'reversed', 0),
(13, 'uiteinden tapen', 'ruban adh&#233;sif sur les extr&#233;mit&#233;s', 'Klebeband am Ende rund Profilenbund', 'taping ends', 'endtape', 0),
(14, 'kopkanten open', 'des faces d''extr&#233;mit&#233; ouvertes', 'offenen EndflÃ¤chen', 'open end faces', 'headopen', 0),
(15, 'kopkanten sluiten', 'des faces d''extr&#233;mit&#233; ferm&#233;es', 'geschlossenen Endflachen', 'end faces close', 'headclose', 0),
(16, 'etiketten op beide kopkanten', '&#233;tiquettes sur les deux faces d''extr&#233;mit&#233;', 'Etiketten auf beiden Endflachen', 'labels on both end faces', 'bothsidetickets', 0),
(17, 'tussen profielen', 'entre les profils', 'zwischen den Profilen', 'between profiles', 'between_profiles', 0),
(18, 'methode', 'mÃ©thode', 'Methode', 'method', 'method', 0),
(19, 'per', 'par', 'pro / per', 'by', 'by', 0),
(20, 'profielen per laag', 'profils par couche', 'Profile pro Lage', 'profiles per layer', 'profiles', 0),
(21, 'lagen per pak', 'couches par paquet', 'Lagen pro Packung', 'layers per pack', 'layers', 0),
(22, 'opdeling', 'division', 'Einteilung', 'division', 'division', 0),
(23, 'totaal', 'total', 'insgesamt', 'total', 'total', 0),
(24, 'melding', 'mentionner', 'Meldung', 'alert', 'alert', 0),
(25, 'afbeelding profielen', 'image des profils', 'Bild der Profile', 'picture of the profiles', 'picture_profiles', 0),
(26, 'afbeelding verpakking', 'image de l''emballage', 'Bild der Verpackung', 'picture of the packaging', 'picture_packaging', 0),
(27, 'opmerking', 'remarque', 'Bemerkung', 'comment', 'comment', 0),
(28, 'opmerking', 'remarque', 'Bemerkung', 'comment', 'comment_nl', 0),
(29, 'opmerking', 'remarque', 'Bemerkung', 'comment', 'comment_fr', 0),
(30, 'opmerking', 'remarque', 'Bemerkung', 'comment', 'comment_en', 0),
(31, 'opmerking', 'remarque', 'Bemerkung', 'comment', 'comment_de', 0),
(32, 'opslaan', 'enregistrez', 'speichern', 'save', 'save', 0),
(33, 'herstel', 'r&#233;cup&#233;ration', 'Reset', 'recover', 'recover', 0),
(34, 'sluiten', 'fermer', 'schlieÃŸen', 'close', 'close', 0),
(35, 'afdrukken', 'imprimer', 'ausdrucken', 'print', 'print', 0),
(36, 'normaal afdrukken', 'imprimer normale', 'normales ausdrucken', 'print normal', 'print_normal', 0),
(37, 'afdrukken voor nabewerker', 'Impression pour &#233;diteur', 'ausdrucken fÃ¼r Nachbewerkung', 'Printing for editor', 'print_editor', 0),
(38, 'openen', 'ouvrir', 'Ã¶ffnen', 'open', 'open', 0),
(39, 'kopiëren', 'copier', 'kopieren', 'duplicate', 'duplicate', 0),
(40, 'Verwijderd', 'supprim&#233;', 'entfernt', 'removed', 'deleted', 0),
(41, 'naar prullenbak verplaatsen', 'mettre &#224; la corbeille', 'deleten', 'move to trash', 'move_to_trash', 0),
(42, 'prullenbak', 'corbeille', 'MÃ¼lleimer', 'trash', 'trash', 0),
(43, 'geschiedenis', 'histoire', 'Geschichte', 'history', 'history', 0),
(44, 'maken', 'cr&#233;er', 'schaffen', 'create', 'create', 0),
(45, 'zoeken', 'rechercher', 'Suche', 'search', 'search', 0),
(46, 'order', 'commande', 'Bestellung', 'order', 'order', 0),
(47, 'vorige', 'pr&#233;c&#233;dent', 'vorige', 'previous', 'previous', 0),
(48, 'volgende', 'suivant', 'nÃ¤chste', 'next', 'next', 0),
(49, 'status', 'statut', 'Status', 'state', 'state', 0),
(50, 'formaat', 'format', 'Format', 'format', 'format', 0),
(51, 'handtekening voor akkoord', 'signature pour approbation', 'Unterschrift fÃ¼r Genehmigung', 'signature for approval', 'signature', 0),
(52, 'Nakijken bij eerste inpak', 'V&#233;rification de l''emballage initial', 'ÃœberprÃ¼fen bei der ersten Verpackungen', 'Checking Initial packaging', 'firstpacking', 0),
(53, 'Opgelet!', 'Attention!', 'Achtung!', 'Caution!', 'alert_revision', 0),
(54, 'Bent u zeker dat u de fiche wil overschrijven met deze revisie? De originele gegevens op de fiche gaan dan verloren. <br/><br/>Bent u zeker, klik dan op OK. Anders klikt u op annuleren.', '&#202;tes-vous s&#251;r de vouloir &#233;craser la fiche avec cette r&#233;vision? Les donn&#233;es originales sur la fiche seront perdues. <br/> <br/> &#202;tes-vous s&#251;r, cliquez sur OK. Sinon, cliquez sur Annuler.', 'Sind Sie sicher, dass Sie die Verpackungsinstruktion mit dieser Ã„nderung Ã¼berschreiben mÃ¶chten? Die ursprÃ¼nglichen Daten auf der Karte sind dann verloren.  <br/><br/> Sind Sie sicher, klicken Sie auf OK. Anders klicken Sie auf Abbrechen.', 'Are you sure you want to overwrite the sheet with this revision? The original data on the sheet will be lost.  <br/><br/> Are you sure, click OK. Otherwise click cancel.', 'alert_revision_txt', 0),
(55, 'Opgelet!', 'Attention!', 'Achtung!', 'Caution!', 'alert_duplicate', 0),
(56, 'U staat op het punt een kopie van deze fiche te maken. Bent u niets vergeten aanpassen?<br/><br/>Bent u zeker dat u deze fiche wil kopieren, klik dan op OK. Anders klikt u op annuleren.', 'Vous &#234;tes sur le point de faire une copie de cette fiche. Avez-vous oubli&#233; changement quelque chose? <br/><br/> &#202;tes-vous s&#251;r de vouloir copier cette fiche puis cliquez s&#251;r OK. Sinon, cliquez s&#251;r Annuler.', 'Sie sind dabei, eine Kopie von dieser Verpackungsinstruktion zu machen. Haben Sie vergessen etwas zu Ã¤ndern?  <br/><br/> Sind Sie sicher, dass Sie diese Instruktion kopieren mÃ¶chten, klicken Sie dann auf OK. Anders klicken Sie auf Abbrechen.', 'You are about to make a copy of this sheet. Haven''t you forgot anything to change? <br/><br/> Are you sure you want to copy this sheet then click OK. Otherwise click cancel.', 'alert_duplicate_txt', 0),
(57, 'Opgelet!', 'Attention!', 'Achtung!', 'Caution!', 'alert_delete', 0),
(58, 'Bent u zeker dat u deze fiche wil verwijderen? <br/><br/>Bent u zeker, klik dan op OK. Anders klikt u op annuleren.', '&#202;tes-vous s&#251;r de vouloir supprimer cette fiche  <br/><br/> &#202;tes-vous s&#251;r, cliquez s&#251;r OK. Sinon, cliquez s&#251;r Annuler.', 'Sind Sie sicher, dass Sie diese Verpackungsinstruktion lÃ¶schen mÃ¶chten? <br/> <br/>Sind Sie sicher, klicken Sie auf OK. Anders klicken Sie auf Abbrechen.', 'Are you sure you want to delete this sheet.  <br/><br/> Are you sure, click OK. Otherwise click cancel.', 'alert_delete_txt', 0),
(59, 'OK', 'Ok', 'OK', 'OK', 'ok', 0),
(60, 'annuleren', 'annuler', 'abbrechen', 'cancel', 'cancel', 0),
(61, 'ja', 'oui', 'ja', 'yes', 'yes', 0),
(62, 'nee', 'non', 'nein', 'no', 'no', 0),
(63, 'versie', 'version', 'Version', 'version', 'revisiondate', 0),
(64, 'gebruikersnaam', 'nom d''utilisateur', 'Benutzername', 'username', 'username', 0),
(65, 'goedkeuren', 'approuver', 'genehmigen', 'approve', 'approve', 0),
(66, 'afwijzen', 'rejeter', 'ablehnen', 'reject', 'reject', 0),
(67, 'referentie klant', 'r&#233;f&#233;rence de client', 'Referenz des Kundens', 'customer reference', 'customerreference', 0),
(68, 'Scan of type Picklist nummer', 'Balayage ou tapez le num&#233;ro de Picklist ', 'einscannen oder Picklist-Nummer eintragen', 'Scan or type Picklist number', 'scanmo', 0),
(69, 'Afdrukken in klanttaal', 'Imprimer du la langue du client', 'Aufdrucken in Client-Sprache', 'Print in client language', 'print_client', 0),
(70, 'verzend', 'envoyer', 'senden', 'send', 'send', 0),
(71, 'Nieuwe verpakkingsfiche voor ', 'Nouveau plan d\\'' emballage pour ', 'Neue Verpackung Vorschlag fur ', 'New packingsheet for ', 'mail_subject_newsheet', 0),
(72, 'Beste', 'Bonjour', 'Guten Tag', 'Hello', 'greeting_casual', 0),
(73, 'Geachte mevrouw, heer', 'Bonjour madame, monsieur', 'Sehr geehrte Frau, Herr', 'Dear Madam, Sir', 'greeting_formal', 0),
(74, 'Dank bij voorbaat <br /> Met vriendelijke groet', 'Merci dâ€™avance <br /> Sinc&#232;rement', 'Danke ins Voraus <br /> Mit freundlichen GrÃ¼ÃŸen', 'Thanks in advance <br /> Sincerely', 'greeting_close', 0),
(75, 'Er wacht een nieuwe fiche op je. Klik op onderstaande link om deze te openen. <br />', '', '', '', 'mailtxt_new', 0),
(76, 'De klant heeft deze fiche goedgekeurd. Klik op onderstaande link om deze te openen. <br/>', '', '', '', 'mailtxt_approved', 0),
(77, 'AFGEWEZEN: Nieuwe verpakkingsfiche voor ', 'REJECT&#201;E: Nouveau plan d\\'' emballage pour ', 'ABGELEHNT: Neue Verpackung Vorschlag fur ', 'REJECTED: New packingsheet for ', 'mail_subject_rejected', 0),
(78, 'GOEDGEKEURD: Nieuwe verpakkingsfiche voor ', 'APPROV&#201;E: Nouveau plan d\\'' emballage pour ', 'GENEHMIGT: Neue Verpackung Vorschlag fur ', 'APPROVED: New packingsheet for ', 'mail_subject_approved', 0),
(79, 'Hoekkarton', 'Coins en carton', 'Pappecken', 'Cardboard corners', 'corners', 0),
(80, 'Geen zijplanken', 'Pas d''&#233;tag&#232;res sur les c&#244;t&#233;s', 'Keine Sideboards', 'No sideboards', 'no_sideboards', 0),
(81, 'Extra omsnoeren (min 2x)', 'Extra bandes en PVC (min 2x)', 'Extra Umreifen mit PVC-Streifen (min 2x)', 'Extra strapping (min 2x)', 'extra_strip', 0),
(82, '<b>Invullen volgens voorbeelden</b><br/><br/>\n<ul>\n<li><b>Schransen:</b> 10/9 (kleinste waarde achteraan) </li>\n<li><b>Pakjes:</b> 5x2</li>\n<li><b>Rest:</b> +4</li>\n<li><b>Schransen met rest:</b> 10/9 +4</li>\n<li><b>Pakjes met rest:</b> 5x2 +4</li>\n<', '', '', '', 'help_division', 0),
(83, 'ontbramen', '&#233;bavurer', 'entgraten', 'deburr', 'deburr', 0),
(84, 'zichtbaar voor leverancier', 'visible pour le fournisseur', 'sichtbar fÃ¼r Lieferant', 'visible for supplier', 'visible_supplier', 0),
(85, 'zichtbaar voor klant', 'visible pour le client', 'sichtbar fÃ¼r Kunde', 'visible for client', 'visible_client', 0),
(86, 'huidig werkcenter', 'werkcenter actuelle', 'aktuelle Werkcenter', 'current werkcenter', 'currentwerkcenter', 0),
(87, 'volgend werkcenter', 'prochaine werkcenter', 'nÃ¤chsten Werkcenter', 'next werkcenter', 'nextwerkcenter', 0),
(88, 'verwijderen', 'enlever', 'entfernen', 'remove', 'remove', 0),
(89, 'eindverpakking', 'emballage final', 'Endverpackung', 'final packaging', 'end', 0),
(90, 'In bijlage vindt u ons inpakvoorstel voor', 'Ci-joint vous trouverez notre proposition dâ€™emballage pour votre profil', 'In Anlage kÃ¶nnen Sie unserem Verpackungsvorschlag zurÃ¼ckfinden vom Profilen', 'Enclosed you can find our packing proposal for', 'mailtxt_request_part1', 0),
(91, 'Mag ik u vriendelijk vragen uw <b>goedkeuring</b> terug te sturen, zodat we in de toekomst zo mogen verpakken? <br/>Bij eventuele vragen of opmerkingen, aarzel dan niet om mij te contacteren.', 'Merci de bien vouloir v&#233;rifier si vous &#234;tes dâ€™accord et dâ€™envoyer votre approbation avec la mention <b>Bon pour accord</b> sur la proposition par retour de cet email. <br/>Sinon, veuillez nous renvoyer vos remarques s.v.p.\n', 'KÃ¶nnen Sie bitte Ihre <b>Genehmigung</b> hierfÃ¼r mitteilen?', 'May I ask you kindly to send us your <b>approval</b> for these instructions, so we can pack your profiles like this in the future? <br/>For questions or comments, please do not hesitate to contact me.', 'mailtxt_request_part2', 0),
(92, 'Gaat u deze profielen ook <b>gelakt of geanodiseerd</b> bestellen? Dan kan ik hiervoor ook een inpakvoorstel aanmaken.', 'Commandez-vous ces profils aussi <b>laqu&#233; ou anodis&#233;</b> ? Afin que je puisse crÃ©er des propositions dâ€™emballage.', 'Werden Sie diese Profile auch <b>beschichtet oder eloxiert</b> bestellen? Dann werde ich ein neuer Verpackungsvorschlag aufstellen.', 'Will you order these profiles also <b>painted or anodized</b>? I will then create a packing proposal.', 'mailtxt_request_part3', 0),
(93, 'OPGELET!', 'ATTENTION!', 'ACHTNUNG!', 'ATTENTION!', 'mailtxt_request_part4', 0),
(94, 'Indien dit voorstel betrekking heeft op een nieuwe matrijs is het mogelijk dat dit voorstel nog wijzigt bij de eerste volledige inpak. Als dat voorkomt, brengen wij u op de hoogte met een nieuw voorstel.', 'Si cette proposition concerne une nouvelle filiÃ¨re, il est possible que cela change encore au premier complÃ¨te emballage. En ce cas, nous vous mettons au courant avec une nouvelle proposition.', 'Wann dieses Vorschlag sich bezieht auf ein neues Werkzeug ist es mÃ¶glich, dass dieser Vorschlag sich noch bei der ersten vollen Verpackung Ã¤ndert. Wenn das gescheht, bringen wir Sie auf dem Laufenden mit einem neuen Vorschlag.', 'If this proposal is based on a new die, it may change during the first complete packing. If that happens, we will get back to you with a new proposal.', 'mailtxt_request_part5', 0),
(95, 'Nederlands', 'n&#233;erlandais', 'NiederlÃ¤ndisch', 'Dutch', 'options_label_nl', 0),
(96, 'Frans', 'fran&#231;ais', 'FranzÃ¶sisch', 'French', 'options_label_fr', 0),
(97, 'Engels', 'anglais', 'Englisch', 'English', 'options_label_en', 0),
(98, 'Duits', 'allemand', 'Deutsch', 'German', 'options_label_de', 0),
(99, 'short', 'short', 'short', 'short', 'short', 0),
(100, 'type', 'Type', 'Typ', 'Type', 'options_label_type', 0),
(101, 'afmelden', 'd&#233;connecter', 'abmelden', 'logout', 'link_logout', 0),
(102, 'afmelden', 'd&#233;connecter', 'abmelden', 'logout', 'logout', 0),
(103, 'opties', 'options', 'Optionen', 'options', 'link_options', 0),
(104, 'filter', 'filtrage', 'Filter', 'filter', 'link_filter', 0),
(105, 'overzicht', 'vue d''ensemble', 'Ãœbersicht', 'overview', 'link_overview', 0),
(106, 'operatie zoeken', 'chercher operation', 'suche Operation', 'search operation', 'picklistchecker', 0),
(107, 'brrrr... onjuiste gebruikersnaam of wachtwoord', 'brrrr... nom d''utilisateur ou mot de passe incorrect', 'brrrr... falscher Benutzername oder Passwort', 'brrrr... incorrect username or password', 'loginerror', 0),
(108, 'normaal opslaan', 'enregistrez normale', 'normales speichern', 'save normal', 'save_normal', 0),
(109, 'opslaan en goedkeuren (zonder versturen)', 'enregistrez et approvez (pas d''envoyer)', 'speichern und genehmigen (nicht senden)', 'save and approve (without sending)', 'save_approved', 0),
(110, 'Scan of type picklist nummer', 'Balayage ou tapez le num&#233;ro de picklist ', 'einscannen oder Picklist-Nummer eintragen', 'Scan or type picklist number', 'scanpl', 0),
(111, 'Scan of type sorteerlijst nummer', 'Balayage ou tapez le num&#233;ro de sortlist', 'einscannen oder Sortlist-Nummer eintragen', 'Scan or type sortlist number', 'scansl', 0),
(112, 'Gelieve eerst uw opdracht op te zoeken', 'SVP d''abord chercher votre mission.', 'Bitte entfernen Sie Ihre Arbeit zu finden', 'Please first search your assignment.', 'editoralert', 0),
(113, 'rechten', 'permissions', 'Berechtigungen', 'permissions', 'permissions', 0),
(114, 'gebruikers', 'utilisateurs', 'Nutzer', 'users', 'users', 0),
(115, 'Op onderstaande link vindt u ons inpakvoorstel voor', 'Sur l''URL ci-dessous vous trouverez notre proposition dâ€™emballage pour votre profil', 'Auf den Link unten kÃ¶nnen Sie unserem Verpackungsvorschlag zurÃ¼ckfinden vom Profilen', 'On the link below you can find our packing proposal for', 'mailtxt_request_part1bis', 0),
(116, '<p class=MsoNormal>Welkom bij <b>â€œBOTAâ€�</b>.</p>\n<p class=MsoNormal>Om uw verpakkingsinstructies te zien, surft u naar onderstaande link en logt u in met onderstaande gegevens.</p>', '<p class=MsoNormal>Bienvenue chez <b>â€œBOTAâ€�</b>.</p>\n<p class=MsoNormal>Pour regarder vos fiches dâ€™emballages, vous allez au lien suivant et vous vous enregistrez  avec les donnÃ©es en bas :</p>', '<p class=MsoNormal>Willkommen <b>â€œBOTAâ€�</b>.</p>\n<p class=MsoNormal>Um Ihre Verpackungsvorschriften zu sehen, mÃ¼ssen Sie nur unten genannte Website besuchen und folgende Daten ausfÃ¼llen.</p>', '', 'mailtxt_register_part1', 0),
(117, 'wachtwoord', 'mot de passe ', 'Passwort', 'password', 'password', 0),
(118, '<p class=MsoNormal><b>Wij raden u ten strengste aan dat u uw wachtwoord wijzigt. </b>Eens u ingelogd bent, klikt u op de grijze balk links van het browservenster. Vervolgens klikt u op â€œAccountâ€�. Daar kunt u uw wachtwoord wijzigen. Er zijn geen b', '<p class=MsoNormal><b>Nous vous conseillons avec insistance de changer votre mot de passe. </b>Un fois que vous Ãªtes enregistrÃ©, vous cliquez sur la barre gris Ã  gauche de lâ€™ Ã©cran. Ensuite vous cliquez sur Â«  account Â». LÃ -bas vous pouvez c', '<p class=MsoNormal><b>Wir empfehlen Sie um Ihr Passwort sicher zu Ã¤ndern. </b>Wenn sie sich angemeldet haben, klicken Sie links auf dem grauen Balken. AnschlieÃŸend klicken Sie auf â€žAccountâ€œ. Dort kÃ¶nnen Sie Ihr Passwort Ã¤ndern. Es gibt keine ', '', 'mailtxt_register_part2', 0),
(119, 'Automatisering verpakkingsinstructies Bota', 'Automatisation fiches d''emballage Bota', 'Automation Verpackungsanweisung Bota', 'Automatisation packaging instructions Bota', 'mail_subject_register', 0),
(120, 'Gelieve hieronder een reden op te geven waarom u dit voorstel afwijst:', 'SVP ajouter une raison pour laquelle vous rejetez cette fiche:', 'Bitte fÃ¼gen Sie einen Grund, warum Sie diese Anweisung ablehnen:', 'Please add a reason for rejecting this sheet:', 'reject_txt', 0),
(121, 'afwijzing verzenden', 'envoyer rejet', 'senden Ablehnung', 'send rejection', 'reject_send', 0),
(122, 'eerste inpak', 'l''emballage initial', 'ersten Verpackungen', 'initial packaging', 'firstpacking_title', 0),
(123, 'Dit voorstel is louter indicatief en kan bij eerste volledige inpak herbekeken worden. Indien dit voorvalt, brengen wij u op de hoogte.', 'Cette proposition est purement indicative et peut reconsid&#233;r&#233;e &#224; premi&#232;re pleine emballage. Si cela se produit, nous vous en informerons.', 'Dieser Vorschlag ist rein indikativ und kÃ¶nnen sich erste volle Verpackung Ã¼berdacht. Wenn dies geschieht, werden wir Sie informieren.', 'This proposal is purely indicative and may at first full packing reconsidered. If this occurs, we will inform you.', 'firstpacking_txt1', 0),
(124, 'Gelieve dit voorlopig voorstel goed te keuren of af te wijzen. Gebruik de knoppen hieronder.', 'SVP compl&#233;ter cette proposition pr&#233;liminaire pour approuver ou rejeter. Utilisez les boutons ci-dessous.', 'Bitte fÃ¼llen Sie dieses vorlÃ¤ufigen Vorschlag zu genehmigen oder abzulehnen. Verwenden Sie die Tasten unten.', 'Please complete this provisional proposal to approve or reject. Use the buttons below.', 'firstpacking_txt2', 0),
(125, 'Gelieve deze instructie na te kijken bij eerste inpak.', 'SVP examiner ces instructions au premier emballage.', 'Bitte Ã¼berprÃ¼fen Sie diese Anweisung nach die erste Packung.', 'Please review this instruction at the first packing.', 'firstpacking_txt3', 0),
(126, 'Daar wij tot op heden nog geen bericht van u hebben ontvangen wat de verpakking van uw aluminium profielen betreft, sturen wij u bij deze een herinnering. <b>Mogen wij u vriendelijk vragen deze instructies zo snel mogelijk goed te keuren?</b>', 'Nous vous avons envoyÃ© par mail la gamme dâ€™emballage de vos profilÃ©s en aluminium.\r\nNâ€™ayant pas eu de remarques de votre part, nous vous enverrons un rappel. \r\n<b>Nous vous demandons dâ€™approuver cette gamme dâ€™emballage dÃ¨s que possible ?</', 'Bis jetzt haben wir von Ihnen noch immer keine BestÃ¤tigung empfangen fÃ¼r den Verpackungsvorschlag von Ihrem Profil(e). Hiermit senden wir Ihnen eine Erinnerung.  <b>Wir bitten Sie diese Verpackungsvorschlag so schnell wie mÃ¶glich zu genehmigen?</b', 'So far we have received no message from you regarding your packing of aluminum profiles. Hereby we will send you a reminder. \r\n<b>We kindly ask you to approve these instructions as soon as possible?</b>', 'mailtxt_reminder', 0),
(127, 'bewerk gebruiker', 'modifier l''utilisateur', 'Benutzerdaten ändern', 'edit user', 'edit_user', 0),
(128, 'email', 'email', 'email', 'email', 'email', 0),
(129, 'bedrijf', 'entreprise', 'Firma', 'company', 'company', 0),
(130, 'wachtwoord bevestigen', 'confirmer mot de passe', 'Passwort bestätigen', 'confirm password', 'confirm_password', 0),
(131, 'taal', 'langue', 'Sprache', 'language', 'lang', 0),
(132, 'Kies uw taal', 'Choisissez votre langue', 'Wählen Sie Ihre Sprache', 'Choose your language', 'choose_lang', 0),
(133, 'gebruikersgroep', 'groupe d''utilisateur', 'Benutzergruppe', 'user group', 'group', 0),
(134, 'Kies uw gebruikersgroep', 'Choisissez votre groupe d''utilisateur', 'Wählen Sie Ihre Benutzergruppe', 'Choose your user group', 'choose_group', 0),
(135, 'bewerk', 'modifier', 'ändern', 'edit', 'edit', 0),
(136, 'Overzicht contacten', 'Liste de contacts', 'Liste der Kontakte', 'List of contacts', 'contactslist', 0),
(137, 'Contactpersoon bewerken', 'modifier contacter', 'Kontakt ändern', 'edit contact', 'edit_contact', 0),
(138, 'fax', 'fax', 'Faxen', 'fax', 'fax', 0),
(139, 'telefoon', 'téléphone', 'Telefon', 'phone', 'phone', 0),
(140, 'Kies...', 'Choisissez...', 'Wählen Sie...', 'Choose...', 'choose', 0),
(141, 'type', 'Type', 'Typ', 'Type', 'type', 0),
(142, 'bekijk', 'voir', 'sehen', 'view', 'view', 0),
(143, 'algemeen', 'général', 'General', 'general', 'department_general', 0),
(144, 'facturatie', 'facturation', 'Fakturierung', 'Billing', 'department_billing', 0),
(145, 'Bestellingen', 'commandes', 'Bestellungen', 'Orders', 'department_order', 0),
(146, 'aankopen', 'achats', 'Einkauf', 'purchase', 'department_purchase', 0),
(147, 'transport en certificaten', 'transport et certificats', 'Transport und Zertifikate', 'transport and certificates', 'department_transport', 0),
(148, 'Verpakking, matrijzen en stalen', 'emballage, des filières et des échantillons', 'Verpackung, Werkzeugen und Musters', 'Packing, dies and samples', 'department_packing', 0),
(149, 'Kwaliteit en klachten', 'Qualité et plaintes', 'Qualität und Klagen', 'Quality and complaints', 'department_quality', 0),
(150, 'afdeling', 'département', 'Abteilung', 'department', 'department', 0),
(151, 'naam', 'nom', 'Name', 'Name', 'name', 0),
(152, 'test', 'test', 'test', 'test', 'test', 0),
(153, 'Oeps! Nog geen contactpersonen.', 'Oops! Pas encore de contacts.', 'Oops! Keine Kontakte.', 'Oops! No contacts yet.', 'empty_heading_contacts', 0),
(154, 'Vul dan het onderstaande formulier in en klik op de knop verzend om een ​​aanvraag te sturen naar de klant.', 'S''il vous plaît remplir le formulaire ci-dessous et cliquez sur le bouton envoyer pour envoyer une demande au client.', 'Bitte füllen Sie das folgende Formular aus und klicken Sie auf die senden Knopfes eine Aufforderung an den Kunden senden.', 'Please complete the form below and click the send button to send a request to the customer', 'empty_text_contacts', 0),
(155, 'Contact opgeslagen!', 'Contact sauvé!', 'Kontakt gerettet!', 'Contact saved!', 'success_contactsaved', 0),
(156, 'Lijst van rechten', 'liste de permissions', 'Liste der Berechtigungen', 'list of permissions', 'permissionslist', 0),
(157, 'gebruiker maken', 'cr&#233;er utilisateur', 'Nutzer schaffen', 'create user', 'create_user', 0),
(158, 'gebruikersgroep maken', 'cr&#233;er groupe d''utilisateur', 'Benutzergruppe schaffen', 'create user group', 'create_group', 0),
(159, 'contacten', 'contacts', 'Kontakte', 'contacts', 'contacts', 0),
(160, 'verpakking', 'emballage', 'Verpackungen', 'packing', 'packing', 0),
(161, 'recht bewerken', 'permission modifier', 'Berechtigung ändern', 'edit permission', 'edit_permission', 0),
(162, 'omschrijving', 'description', 'Umschreibung', 'description', 'description', 0),
(163, 'recht maken', 'permission cr&#233;er', 'Berechtigung schaffen', 'create permission', 'create_permission', 0),
(164, 'account', 'account', 'account', 'account', 'account', 0),
(165, 'nieuwe contactpersonen opgeven', 'défin de nouveaux contacts', 'neue Kontakte angeben', 'enter new contacts', 'enter_newcontacts', 0),
(166, 'Badankt!', 'Merci!', 'Danke!', 'Thanks!', 'empty_heading_newcontacts', 0),
(167, 'U hebt uw contacten ingevoerd.', 'Vous avez enregistré vos contacts.', 'Sie haben Ihre Kontakte eingetragen.', 'You have entered your contacts.', 'empty_text_newcontacts', 0),
(168, 'Wenst u hulp? Klik op next. Om te stoppen, klik skip. U kunt steeds help oproepen door op deze knop te klikken.', 'Souhaitez-vous aider? Cliquez sur next. Pour arrêter, cliquez sur skip. Vous pouvez toujours aider en appuyant sur ce bouton.', 'Möchten Sie helfen? Klicken Sie auf next. Um zu beenden, klicken skip. Sie können immer noch durch Drücken dieser Taste zu helfen.', 'Would you like some help? Click on next. To stop, click skip. You can still call for help by clicking this button.', 'intro_help', 0),
(169, 'Vul hier de gegevens van uw algemeen contactpersoon in. Vul de voornaam en naam, emailadres, rechtstreeks telefoonnummer en faxnummer in. Telefoonnummers en faxnummers mogen enkel cijfers zijn inclusief de 00 landcode (vb.: 0032 voor België of 0031 voor Nederland)', 'Entrez les coordonnées de votre contact général. Entrez le nom et prénom, adresse e-mail, téléphone direct et le numéro de fax. Les numéros de téléphone et de fax peut seulement chiffres incluent le code 00 pays (par exemple 0032 pour la Belgique ou 0033 pour la France)', 'Geben Sie die Details Ihrer allgemeinen Kontakt. Geben Sie den Vor-und Nachnamen, E-Mail-Adresse, Telefon-und Faxnummer. Telefon-und Faxnummern darf nur Zahlen enthalten die 00 Landesvorwahl (zB 0049 für Deutschland)', 'Enter the details of your general contact. Enter the first and last name, email address, direct telephone and fax number. Phone and fax numbers may be only figures include the 00 country code (eg 0032 for Belgium)', 'intro_newcontact_firstcontact', 0),
(170, 'Duidt hier aan voor welke afdelingen deze persoon instaat. Eén contactpersoon kan meerdere afdelingen hebben. Gebruik voor uw eerste contactpersoon steeds de afdeling algemeen, eventueel aangevuld met andere afdelingen.', 'Indiquez ici pour tous les départements de cette personne est responsable. Un contact peut avoir plusieurs départements. Les départements peuvent également être appliqués à plusieurs contacts. Pour votre premier contact, utilisez le départements général, complété éventuellement avec d''autres départements.', 'Geben Sie hier für alle Abteilungen, die verantwortliche Person ist. Ein Kontakt kann mehreren Abteilungen. Abteilungen können auch mehrere Kontakte angewandt werden. Für Ihren ersten Kontakt mit der allgemeinen Abteilung, möglicherweise mit anderen Abteilungen ergänzt.', 'Indicate here for any departments that person is responsible. One contact can have multiple departments. Departments can also be applied to multiple contacts. For your first contact use the department generally, possibly supplemented with other departments.', 'intro_newcontact_departements', 0),
(171, 'Wenst u een extra contactpersoon toe te voegen, klik op deze knop en vul de gegevens en afdelingen aan.', 'Voulez-vous un contact supplémentaire à ajouter, cliquez sur ce bouton et remplissez les détails et les départements.', 'Möchten Sie eines weiteren Kontaktes hinzufügen, auf diesen Knopf und füllen die Details und Abteilungen.', 'Would you like to add an additional contact, click on this button and fill in the details and departments.', 'intro_newcontact_addcontact', 0),
(172, 'Bent u klaar met het invullen van alle contactpersonen en afdelingen? Klik dan op deze knop om de contactpersonen op te slaan. Als er afdelingen zijn die u niet heeft aangeduid, dan worden deze afdelingen op de eerste contactpersoon geplaatst.', 'Lorsque vous avez fini de remplir tous les contacts et les départements? Cliquez sur ce bouton pour enregistrer les contacts. S''il ya des départements que vous n''avez pas identifiés, ces départemenets sont placées sur le premier contact.', 'Wenn Sie fertig sind Ausfüllen alle Kontakte und Abteilungen? Klicken Sie auf diese Knopf, um die Kontakte zu speichern. Wenn es Abteilungen von Ihnen nicht identifiziert sind, dann diese Abteilungen auf dem ersten Kontakt angeordnet.', 'When you have finished filling out all contacts and departments? Click this button to save the contacts. If there are departments that you have not identified, then these departments are placed on the first contact.', 'intro_newcontact_finish', 0),
(173, 'extra contact toevoegen', 'ajouter un contact supplémentaire', 'fügen Sie zusätzliche Kontakt', 'add extra contact', 'add_extra_contact', 0),
(174, 'afdeling', 'département', 'Abteilung', 'departement', 'departement', 0),
(175, 'voornaam', 'prénom', 'Vorname', 'first name', 'first_name', 0),
(176, 'familienaam', 'nom', 'Nachname', 'lLast name', 'last_name', 0),
(177, 'Contact verwijderd!', 'Contact supprimé!', 'Kontakt gelöscht!', 'Contact deleted!', 'success_contactdelete', 0),
(178, 'verwijderen', 'supprimer', 'löschen', 'delete', 'delete', 0),
(179, 'Weet u zeker dat u dit wilt verwijderen?', 'Êtes-vous sûr de vouloir supprimer ce?', 'Sind Sie sicher, dass Sie dies wirklich löschen?', 'Are you sure you want to delete this?', 'delete_txt', 0),
(180, 'opmerkingen', 'remarques', 'Bemerkungen', 'comments', 'comments', 0),
(181, 'titel', 'titre', 'Titel', 'title', 'title', 0),
(182, 'normaal', 'normal', 'normal', 'normal', 'normal', 0),
(183, 'belangrijk', 'important', 'wichtig', 'important', 'important', 0),
(184, 'urgent', 'urgent', 'urgent', 'urgent', 'urgent', 0),
(185, 'prioriteit', 'priorité', 'Priorität', 'priority', 'priority', 0),
(186, 'categorie', 'catégorie', 'Kategorie', 'category', 'category', 0),
(187, 'lorem', 'lorem', 'lorem', 'LoremgiugigJHUO', 'category_loremgiugigjhuo', 0),
(188, 'ipsum', 'ipsum', 'ipsum', 'ipsum', 'category_ipsum', 0),
(189, 'dolor', 'dolor', 'dolor', 'dolor', 'category_dolor', 0),
(190, 'sit', 'sit', 'sit', 'sit', 'category_sit', 0),
(191, 'amet', 'amet', 'amet', 'amet', 'category_amet', 0),
(192, 'categorie bewerken', 'modifier catégorie', 'Kategorie ändern', 'edit category', 'edit_category', 0),
(193, 'opmerking bewerken', 'modifier remarque', 'Bemerkung ändern', 'edit comment', 'edit_comment', 0),
(194, 'categorieën', 'catégories', 'Kategorien', 'categories', 'categories', 0),
(195, 'kleur', 'couleur', 'Farbe', 'color', 'color', 0),
(196, 'blauw', 'bleu', 'blau', 'blue', 'blue', 0),
(197, 'donkerblauw', 'bleu foncé', 'dunkelblau', 'dark blue', 'bluedark', 0),
(198, 'groen', 'vert', 'grün', 'green', 'green', 0),
(199, 'donkergroen', 'vert foncé', 'dunkelgrün', 'dark green', 'greendark', 0),
(200, 'geel', 'jaune', 'gelb', 'yellow', 'yellow', 0),
(201, 'roze', 'rose', 'rosa', 'pink', 'pink', 0),
(202, 'paars', 'violet', 'violett', 'purple', 'purple', 0),
(203, 'lila', 'lila', 'lila', 'lila', 'lila', 0),
(204, 'grijs', 'gris', 'grau', 'gray', 'gray', 0),
(205, 'fuschia', 'fuschia', 'fuschia', 'fuschia', 'fuschia', 0),
(206, 'Duits', 'allemand', 'Deutsch', 'german', 'german', 0),
(207, 'Nederlands', 'néerlandais', 'Niederländisch', 'dutch', 'dutch', 0),
(208, 'Frans', 'français', 'Französisch', 'french', 'french', 0),
(209, 'Engels', 'anglais', 'Englisch', 'english', 'english', 0),
(212, 'Algemeen', 'Général', 'Algemein', 'General', 'category_general', 0),
(213, 'maandag', 'lundi', 'Montag', 'Monday', 'monday', 0),
(214, 'dinsdag', 'mardi', 'Dienstag', 'Tuesday', 'tuesday', 0),
(215, 'woensdag', 'mercredi', 'Mittwoch', 'Wednesday', 'wednesday', 0),
(216, 'donderdag', 'jeudi', 'Donnertag', 'Thursday', 'thursday', 0),
(217, 'vrijdag', 'vendredi', 'Freitag', 'friday', 'friday', 0),
(218, 'zaterdag', 'samedi', 'samstag', 'Saturday', 'saturday', 0),
(219, 'zondag', 'dimanche', 'Sonntag', 'Sunday', 'sunday', 0),
(220, 'openingsuren', 'heures d''ouverture', 'Öffnungszeiten', 'business hours', 'businesshours', 0),
(221, 'voormiddag', 'avant midi', 'Vormittag', 'morning', 'morning', 0),
(222, 'namiddag', 'après-midi', 'Nachmittag', 'afternoon', 'afternoon', 0),
(223, 'sluiting', 'fermeture', 'Schließung', 'closed', 'closeday', 0),
(224, 'levering', 'livraison', 'Lieferung', 'delivery', 'deliveryday', 0),
(225, 'van', 'de', 'von', 'from', 'from', 0),
(226, 'tot', 'à', 'zu', 'to', 'to', 0),
(227, 'leverdagen', 'Jours de livraison', 'Liefertagen', 'delivery days', 'deliverydays', 0),
(228, 'leverdagen bewerken', 'modifier jours de livraison', 'Liefertagen ändern', 'edit delivery days', 'edit_deliverydays', 0),
(229, 'adres', 'adresse', 'Adresse', 'address', 'address', 0),
(230, 'Leverdagen opgeslagen!', 'Jours de livraison sauvé!', 'Liefertagen gerettet!', 'Delivery days saved!', 'success_deliverydayssaved', 0),
(231, 'filter leverdagen', 'filtrer jours de livraison', 'Liefertagen filtern', 'filter delivery days', 'filter_deliverydays', 0),
(232, 'acties', 'actions', 'Aktionen', 'actions', 'actions', 0),
(233, 'land', 'pays', 'Land', 'country', 'country', 0),
(234, 'postcode', 'code postal', 'Postleitzahl', 'postcode', 'postcode', 0),
(235, 'algemeen', 'général', 'General', 'general', 'general', 0),
(236, 'adresnaam', 'nom d''adresse', 'Adressename', 'address name', 'addressname', 0),
(237, 'adresnaam', 'nom d''adresse', 'Adressename', 'address name', 'addressname', 0),
(238, 'messenger', 'messenger', 'messenger', 'messenger', 'messenger', 0),
(239, 'onderwerp', 'sujet', 'Betreff', 'subject', 'subject', 0),
(240, 'bericht', 'message', 'Nachricht', 'message', 'message', 0),
(241, 'Bent u zeker dat u dit wil verwijderen?', 'Êtes-vous sûr de vouloir supprimer ce?', 'Sind Sie sicher, dass dies wirklich löschen?', 'Are you sure to delete this?', 'delete_sure', 0),
(242, 'globale opmerkingen', 'remarques général', 'global Kommentare', 'global comments', 'global_comments', 0),
(243, 'levertermijnen', 'conditions de livraison', 'Liefertermine', 'delivery terms', 'deliveryterms', 0),
(244, 'termijn', 'condition', 'Termin', 'term', 'term', 0),
(245, 'datum', 'date', 'Datum', 'date', 'date', 0),
(246, 'levertermijn bewerken', 'modifier condition de livraison', 'Liefertermin ändern', 'edit  delivery term', 'edit_deliveryterms', 0),
(247, 'kg', 'kg', 'kg', 'kg', 'priceunit_kg', 0),
(248, 'Enkelvoudig', 'singulier', 'Singular', 'singular', 'pricetype_singular', 0),
(249, 'm', 'm', 'm', 'm', 'priceunit_m', 0),
(250, 'stuk', 'pièce', 'Stück', 'piece', 'priceunit_piece', 0),
(251, 'prijzen', 'prix', 'Preis', 'prices', 'prices', 0),
(252, 'prijs bewerken', 'modifier prix', 'Preis ändern', 'edit price', 'edit_price', 0),
(253, 'prijs', 'prix', 'Preis', 'price', 'price', 0),
(254, 'eenheid', 'unité', 'Einheit', 'unit', 'priceunit', 0),
(255, 'soort prijs', 'type de prix', 'Preistyp', 'price type', 'pricetype', 0),
(256, 'link', 'lien', 'Link', 'link', 'pricetype_link', 0),
(257, 'link', 'lien', 'Link', 'link', 'link', 0),
(258, 'formules', 'formules', 'Formuln', 'formulas', 'formulas', 0),
(259, 'formule', 'formule', 'Formul', 'formula', 'formula', 0),
(260, 'formule bewerken', 'modifier formule', 'Formul ändern', 'edit formula', 'edit_formula', 0),
(261, 'profiel', 'profil', 'Profil', 'profile', 'profile', 0),
(262, 'koers', 'échange', 'Kurse', 'exchange', 'exchange', 0),
(263, 'vakantie', 'vacances', 'Urlaub', 'holidays', 'holidays', 0),
(264, 'vakantie bewerken', 'modifier vacances', 'Urlaub ändern', 'edit holiday', 'edit_holiday', 0),
(265, 'tot', 'à', 'zu', 'until', 'until', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lme`
--

CREATE TABLE IF NOT EXISTS `lme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exchange` float NOT NULL,
  `cash` float NOT NULL,
  `mth` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mailtext`
--

CREATE TABLE IF NOT EXISTS `mailtext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nl` varchar(250) CHARACTER SET utf8 NOT NULL,
  `fr` varchar(250) CHARACTER SET utf8 NOT NULL,
  `de` varchar(250) CHARACTER SET utf8 NOT NULL,
  `en` varchar(250) CHARACTER SET utf8 NOT NULL,
  `short` varchar(250) CHARACTER SET utf8 NOT NULL,
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`short`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `mailtext`
--

INSERT INTO `mailtext` (`id`, `nl`, `fr`, `de`, `en`, `short`, `delete`) VALUES
(1, 'Geachte mevrouw, heer', 'Bonjour madame, monsieur', 'Sehr geehrte Frau, Herr', 'Dear Madam, Sir', 'greeting', 0),
(2, 'Dank bij voorbaat &#124; Met vriendelijke groet', 'Merci d’avance &#124; Sinc&#232;rement', 'Danke ins Voraus &#124; Mit freundlichen Grüßen', 'Thanks in advance &#124; Sincerely', 'thanks', 0),
(3, '<p>Welkom.</p> <p>Gelieve via onderstaande link, jullie gegevens zo correct en volledig mogelijk aan te vullen. Vergeet nadien zeker niet op de blauwe knop &ldquo;verzenden&rdquo; te klikken.<p>', '<p>Bienvenue.</p> <p>Merci de suivre le lien en bas et de remplir tous les infos le plus correct en complet que possible. N&#39;oubliez pas de cliquer sur le bouton &ldquo; envoyer &rdquo; à la fin.</p>', '<p>Wilkimmen.</p> <p>Bitte die korrekte Daten so komplett wie m&#246;glich ausfüllen, durch auf unterem Link zu klicken. Vergessen Sie nachdem nicht auf den blauen Knopf &ldquo;versenden&rdquo; zu klicken.</p>', '<p>Welcome.</p> <p>Please click on the link below and fill out the form with your contact information as complete as possible. Don''t forget to hit the blue send button when your finished.</p>', 'newcontact', 0),
(4, 'Welkom', 'Bienvenue', 'Wilkimmen', 'Welcome', 'subject_welcome', 0),
(5, 'Nieuwe contactpersonen die zijn opgeslagen door de klant ', 'Nouveaux contacts sauvés par le client ', 'Neue Kontakte gespeichert durch den Kunden ', 'New contacts saved by customer ', 'subject_newcontact_saved', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Gegevens worden uitgevoerd voor tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'View overview', ''),
(2, 'View sheet', ''),
(3, 'View customers credentials', ''),
(4, 'Delete sheets', ''),
(5, 'Filter sheets', ''),
(6, 'View firstrun', ''),
(7, 'View options', ''),
(8, 'View permissions', ''),
(9, 'View filters', ''),
(10, 'View picklists', ''),
(11, 'Print sheets', 'This is ONLY for master and admin'),
(12, 'Save sheets', ''),
(13, 'View trash', ''),
(14, 'Search by state', ''),
(15, 'Search by profile', ''),
(16, 'Search by customer', ''),
(17, 'Only own results', 'Used only on customer group to get only those sheets by there customernumber (= username)'),
(18, 'Search by finish', ''),
(19, 'Create sheets', ''),
(20, 'Search by filter', ''),
(21, 'Search by filter picklist', 'Only for viewers'),
(22, 'Search by filter sortlist', 'Only for editors and painters'),
(23, 'Search by filter both picklist and sortlist', ''),
(24, 'View sidebar', ''),
(25, 'View users', ''),
(26, 'Edit own account', ''),
(27, 'Edit all accounts', ''),
(28, 'First search', ''),
(29, 'Only approved sheets', ''),
(30, 'Only firstpacking sheets', ''),
(31, 'Only customer states', ''),
(32, 'Send sheets', ''),
(33, 'Approve sheets', ''),
(34, 'Reject sheets', ''),
(35, 'Print sheets editor', ''),
(36, 'Print sheets normal', ''),
(37, 'View alert', ''),
(38, 'Is customer', ''),
(39, 'Visible for supplier', ''),
(40, 'Duplicate sheets', ''),
(41, 'View revisions', ''),
(42, 'Focus order', ''),
(43, 'Edit usergroup', ''),
(44, 'Create user', ''),
(45, 'Create group', ''),
(46, 'User equals workcenter', ''),
(48, 'Edit permissions', ''),
(49, 'Create permissions', ''),
(50, 'View contacts', ''),
(51, 'Edit contact', ''),
(52, 'Create contact', ''),
(53, 'View comments', ''),
(54, 'Edit comments', ''),
(55, 'View comments categories', ''),
(56, 'Edit comments categories', ''),
(57, 'View deliverydays', ''),
(58, 'Edit deliverydays', ''),
(59, 'messenger', 'messenger'),
(60, 'View Global Comments', ''),
(61, 'View delivery terms', ''),
(62, 'View prices', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permissions_groups`
--

CREATE TABLE IF NOT EXISTS `permissions_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `permissions_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Gegevens worden uitgevoerd voor tabel `permissions_groups`
--

INSERT INTO `permissions_groups` (`id`, `permissions_id`, `group_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 23, 1),
(4, 23, 2),
(5, 10, 1),
(6, 10, 2),
(7, 32, 1),
(8, 32, 2),
(9, 43, 1),
(10, 43, 2),
(11, 27, 1),
(12, 27, 2),
(13, 9, 1),
(14, 9, 2),
(15, 25, 1),
(16, 25, 2),
(17, 44, 1),
(18, 44, 2),
(19, 45, 1),
(20, 13, 1),
(21, 13, 2),
(22, 2, 1),
(23, 2, 2),
(24, 3, 1),
(25, 3, 2),
(26, 5, 1),
(27, 5, 2),
(28, 6, 1),
(29, 6, 2),
(30, 7, 1),
(31, 7, 2),
(32, 12, 1),
(33, 12, 2),
(34, 14, 1),
(35, 14, 2),
(36, 15, 1),
(37, 15, 2),
(38, 16, 1),
(39, 16, 2),
(40, 18, 1),
(41, 18, 2),
(42, 19, 1),
(43, 19, 2),
(44, 20, 1),
(45, 20, 2),
(46, 24, 1),
(47, 24, 2),
(48, 26, 1),
(49, 26, 2),
(50, 37, 1),
(51, 37, 2),
(52, 40, 1),
(53, 40, 2),
(54, 41, 1),
(55, 41, 2),
(56, 33, 1),
(57, 33, 2),
(58, 34, 1),
(59, 34, 2),
(60, 8, 1),
(61, 8, 2),
(62, 11, 1),
(63, 11, 2),
(64, 1, 1),
(65, 1, 2),
(66, 47, 1),
(67, 48, 1),
(68, 48, 2),
(69, 49, 1),
(70, 49, 2),
(71, 50, 1),
(72, 50, 2),
(73, 51, 1),
(74, 51, 2),
(75, 52, 1),
(76, 52, 2),
(77, 55, 1),
(78, 55, 2),
(79, 56, 1),
(80, 56, 2),
(81, 57, 1),
(82, 57, 2),
(83, 58, 1),
(84, 58, 2),
(85, 53, 1),
(86, 53, 2),
(87, 54, 1),
(88, 54, 2),
(89, 59, 1),
(90, 59, 2),
(91, 60, 1),
(92, 60, 2),
(93, 61, 1),
(94, 61, 2),
(95, 62, 1),
(96, 62, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customernumber` varchar(250) NOT NULL,
  `price` double NOT NULL,
  `priceunit_id` int(11) NOT NULL,
  `profile` varchar(5) NOT NULL,
  `finish` varchar(250) NOT NULL,
  `length` float NOT NULL,
  `formula_id` int(11) NOT NULL,
  `formula_string` text NOT NULL,
  `formula_data` text NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pricetypes`
--

CREATE TABLE IF NOT EXISTS `pricetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `short` varchar(250) NOT NULL,
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `priceunits`
--

CREATE TABLE IF NOT EXISTS `priceunits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `short` varchar(250) NOT NULL,
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `priceunits`
--

INSERT INTO `priceunits` (`id`, `name`, `short`, `delete`) VALUES
(1, 'kg', 'kg', 0),
(2, 'm', 'm', 0),
(3, 'piece', 'piece', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `return_to_sender`
--

CREATE TABLE IF NOT EXISTS `return_to_sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `extra` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `lang` varchar(100) NOT NULL,
  `firstrun` int(11) NOT NULL DEFAULT '0',
  `sendpdf` int(11) NOT NULL DEFAULT '0',
  `userDashboard` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `lang`, `firstrun`, `sendpdf`, `userDashboard`) VALUES
(1, '\0\0', 'master', '6897fb1054f65fb85eaaf92d8d265a8757baa62e', '9462e8eee0', 'master@example.com', '', NULL, NULL, NULL, 1268889823, 1368691530, 1, 'John', 'Doe', 'John Doe Comapny', '80012312345', 'en', 0, 0, ''),
(2, '\0\0', 'superadmin', '6897fb1054f65fb85eaaf92d8d265a8757baa62e', '9462e8eee0', 'superadmin@example.com', '', NULL, NULL, NULL, 1268889823, 1368691530, 1, 'Lucy', 'Zoe', 'John Doe Comapny', '80012312345', 'en', 0, 0, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
