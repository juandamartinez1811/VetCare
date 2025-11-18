// Seleccionar la base de datos
use('estadisticas');

db.getCollectionNames();
db.citas.countDocuments();
db.citas.aggregate([
  { $group: { _id: "$motivo", total: { $sum: 1 } } }
]);
db.citas.aggregate([
  { $group: { _id: "$fecha", total: { $sum: 1 } } }
]);
db.citas.aggregate([
  {
    $group: {
      _id: { $substr: ["$fecha", 0, 7] },
      total: { $sum: 1 }
    }
  }
]);
